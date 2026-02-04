<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Transaction;
use App\Models\Account;
use App\Models\Category;
use App\Models\Setting;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Exception;

class DataManagement extends Component
{
    use WithFileUploads;

    public $csvFile;
    public $importResults = null;

    public $theme = 'system';
    public $currency = 'RM';

    public function mount()
    {
        $this->theme = Setting::get('theme', 'system');
        $this->currency = Setting::get('currency', 'RM');
    }

    public function updatedTheme($value)
    {
        Setting::set('theme', $value);
        $this->dispatch('toast', message: 'Theme updated!', type: 'success');
        $this->dispatch('theme-updated', theme: $value);
    }

    public function updatedCurrency($value)
    {
        Setting::set('currency', $value);
        $this->dispatch('toast', message: 'Currency updated!', type: 'success');
    }

    public function render()
    {
        return view('livewire.data-management')
            ->layout('layouts.app', ['title' => 'Finance Tracker - Data Management']);
    }

    public function export()
    {
        $transactions = Transaction::with(['account', 'category'])->get();

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=transactions_export_" . now()->format('Y-m-d') . ".csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $columns = ['Date', 'Description', 'Account', 'Category', 'Amount', 'Type'];

        $callback = function () use ($transactions, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($transactions as $transaction) {
                fputcsv($file, [
                    $transaction->date->format('Y-m-d'),
                    $transaction->description,
                    $transaction->account->name,
                    $transaction->category?->name ?? 'N/A',
                    abs($transaction->amount),
                    $transaction->category?->type ?? 'expense',
                ]);
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }

    public function downloadTemplate()
    {
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=transaction_template.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $columns = ['Date', 'Description', 'Account Name', 'Category Name', 'Amount', 'Type (income/expense)'];

        $callback = function () use ($columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            // Example row
            fputcsv($file, [now()->format('Y-m-d'), 'Example Transaction', 'Main Account', 'Food', '50.00', 'expense']);
            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }

    public function import()
    {
        $this->validate([
            'csvFile' => 'required|mimes:csv,txt|max:1024',
        ]);

        $path = $this->csvFile->getRealPath();
        $file = fopen($path, 'r');

        $header = fgetcsv($file); // Skip header

        $successCount = 0;
        $errorCount = 0;
        $errors = [];
        $rowCount = 0;

        DB::beginTransaction();

        try {
            while (($row = fgetcsv($file)) !== FALSE) {
                $rowCount++;
                if (count($row) < 6) {
                    $errors[] = "Row {$rowCount}: Invalid column count.";
                    $errorCount++;
                    continue;
                }

                [$date, $description, $accountName, $categoryName, $amount, $type] = $row;

                $account = Account::where('name', $accountName)->first();
                if (!$account) {
                    $errors[] = "Row {$rowCount}: Account '{$accountName}' not found.";
                    $errorCount++;
                    continue;
                }

                $category = Category::where('name', $categoryName)->where('type', $type)->first();
                if (!$category) {
                    // Try finding by name only if type doesn't match exactly
                    $category = Category::where('name', $categoryName)->first();
                    if (!$category) {
                        $errors[] = "Row {$rowCount}: Category '{$categoryName}' not found.";
                        $errorCount++;
                        continue;
                    }
                }

                $numericAmount = floatval($amount);
                if ($type === 'expense') {
                    $numericAmount = -abs($numericAmount);
                } else {
                    $numericAmount = abs($numericAmount);
                }

                try {
                    Transaction::create([
                        'account_id' => $account->id,
                        'category_id' => $category->id,
                        'amount' => $numericAmount,
                        'description' => $description,
                        'date' => $date,
                    ]);

                    $account->balance += $numericAmount;
                    $account->save();

                    $successCount++;
                } catch (Exception $e) {
                    $errors[] = "Row {$rowCount}: " . $e->getMessage();
                    $errorCount++;
                }
            }

            DB::commit();

            $this->importResults = [
                'success' => $successCount,
                'errors' => $errors,
                'errorCount' => $errorCount,
            ];

            $this->reset('csvFile');
            $this->dispatch('toast', message: "Import complete! {$successCount} records imported.", type: 'success');

        } catch (Exception $e) {
            DB::rollBack();
            $this->dispatch('toast', message: "Import failed: " . $e->getMessage(), type: 'error');
        }

        fclose($file);
    }
}

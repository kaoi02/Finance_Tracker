<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use Exception;

class Categories extends Component
{
    public $categories;
    public $name;
    public $icon;
    public $type = 'expense';

    public $showDeleteModal = false;
    public $idToDelete = null;

    public function confirmDelete()
    {
        if ($this->idToDelete) {
            $this->delete($this->idToDelete);
            $this->idToDelete = null;
            $this->showDeleteModal = false;
        }
    }

    public function render()
    {
        $this->categories = Category::all();
        return view('livewire.categories')->layout('layouts.app', ['title' => 'Finance Tracker - Categories']);
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'type' => 'required',
        ]);

        try {
            Category::create([
                'user_id' => 1,
                'name' => $this->name,
                'icon' => $this->icon,
                'type' => $this->type,
            ]);

            $this->reset(['name', 'icon', 'type']);
            $this->dispatch('toast', message: 'Category added!', type: 'success');
        } catch (Exception $e) {
            $this->dispatch('toast', message: 'Failed to add category.', type: 'error');
        }
    }

    public function delete($id)
    {
        try {
            Category::findOrFail($id)->delete();
            $this->dispatch('toast', message: 'Category removed.', type: 'info');
        } catch (Exception $e) {
            $this->dispatch('toast', message: 'Failed to remove category.', type: 'error');
        }
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;

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

        Category::create([
            'user_id' => 1,
            'name' => $this->name,
            'icon' => $this->icon,
            'type' => $this->type,
        ]);

        $this->reset(['name', 'icon', 'type']);
        $this->dispatch('toast', message: 'Category added!', type: 'success');
    }

    public function delete($id)
    {
        Category::find($id)->delete();
        $this->dispatch('toast', message: 'Category removed.', type: 'info');
    }
}

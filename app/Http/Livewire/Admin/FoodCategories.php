<?php

namespace App\Http\Livewire\Admin;

use App\Models\FoodCategory;
use Livewire\Component;

class FoodCategories extends Component
{
    public $name;
    public $addCategoryModal;

    public function render()
    {
        $categories = FoodCategory::paginate(15);
        return view('livewire.admin.food-categories', compact('categories'));
    }

    public function clearFields(){
        $this->name= '';
    }

    public function addCategory(){
        $this->validate([
            'name' => 'required',
        ]);

        $center = new FoodCategory();
        $center->name = $this->name;
        $center->save();

        $this->addCategoryModal = false;

        $this->clearFields();


    }

    public function openAddCategoryModal(){
        $this->resetErrorBag();
        $this->clearFields();
        $this->addCategoryModal = !$this->addCategoryModal;
    }
}

<?php

namespace App\Http\Livewire\Admin;

use App\Models\Food;
use App\Models\FoodCategory;
use App\Models\FoodCentre;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Foods extends Component
{
    use WithPagination, WithFileUploads;

    public $addFoodModal;
    public $name, $price, $category, $center, $image, $notes;

    public function render()
    {
        $foods = Food::with(['getCategory', 'getCenter'])->paginate(10);
        
        $categories = FoodCategory::all();
        $centers = FoodCentre::all();
        return view('livewire.admin.foods', compact('foods', 'categories', 'centers'));
    }

    public function clearFields(){
        $this->name= '';
        $this->price= '';
        $this->category= '';
        $this->center= '';
        $this->image= '';
        $this->notes= '';
    }

    public function addFood(){
        $validateData = [
            'name' => 'required',
            'price' => 'required',
            'category' => 'required',
            'center' => 'required',
        ];

        // $food = new Food();
        $data = [

            'name' => $this->name,
            'price' => $this->price,
            'food_category_id' => $this->category,
            'food_center_id' => $this->center,
            // 'image' => $this->image,
            'notes' => $this->notes,
        ];

        $imageHashName = $this->image->hashName();

        $validateData = array_merge($validateData, [
            'image'=> 'image',
        ]);

        $data = array_merge($data,[
            'image' => $imageHashName,
        ]);

        $this->image->store('public/food_pictures');

        $this->validate($validateData);

        Food::create($data);

        $this->addFoodModal = false;

        $this->clearFields();

        


    }

    public function openAddFoodModal(){
        $this->resetErrorBag();
        $this->clearFields();
        $this->addFoodModal = !$this->addFoodModal;
    }
}

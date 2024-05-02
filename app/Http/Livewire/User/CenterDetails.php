<?php

namespace App\Http\Livewire\User;

use App\Models\Food;
use App\Models\FoodCategory;
use Livewire\Component;
use Cart;
use WireUi\Traits\Actions;

class CenterDetails extends Component
{
    use Actions; 
    public $center, $name=[];
    public $categories;
    public $selectedCategory;
    public $selectedCategoryName;


    public function setActiveCategory($id){
        $this->selectedCategory = $id;
        $name = $this->categories->where('id', $id)->first();
        $this->selectedCategoryName = $name->name;
    }

    public function resetActiveCategory(){
        $this->selectedCategory = '';
    }

    public function addFoodToCart($id){
        $food = Food::findOrFail($id);
        // dd($food);
        Cart::add([
            'id' => $food->id,
            'name' => $food->name,
            'qty' => 1,
            'price' => $food->price,
            'weight' => 0,
            'options' => [
                'image' => $food->image,
                'restaurant_id' => $food->food_center_id,
            ]
        ]);

        $this->notification()->success(
            $title = 'Item added to cart',
            $description = ''
        );

        $this->emit('itemCount');

        // dd(Cart::content());
    }

    public function render()
    {
        if(empty($this->selectedCategory)){

            $foods = Food::where('food_center_id', '=', $this->center->id)->get();
        }
        if(!empty($this->selectedCategory)){
            $foods = Food::where('food_center_id', '=', $this->center->id)
            ->where('food_category_id', '=', $this->selectedCategory)
            ->get();
        }
        return view('livewire.user.center-details', compact('foods'));
    }
}

<?php

namespace App\Http\Livewire\User;

use App\Models\FoodCentre;
use Livewire\Component;
use Livewire\WithPagination;

class Restaurants extends Component
{
   use WithPagination;
    
    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        if(empty($this->search)){
            $foodCenters = FoodCentre::paginate(15);
            return view('livewire.user.restaurants', compact('foodCenters'));
        }
        
        if($this->search != ''){
            $foodCenters = FoodCentre::where('name', 'like', '%'.$this->search.'%')->paginate(15);
            return view('livewire.user.restaurants', compact('foodCenters'));
        }
    }
}

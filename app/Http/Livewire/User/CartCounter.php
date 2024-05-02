<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Cart;

class CartCounter extends Component
{
    protected $listeners = ['itemCount'=> 'render'];

    // public function refreshCartContent(){
    //     if(!empty(Cart::content())){
    //         $this->emit('refreshCart');
    //     }
        
    // }

    public function render()
    {
        $itemsCount = Cart::content()->count();
        return view('livewire.user.cart-counter', compact('itemsCount'));
    }
}

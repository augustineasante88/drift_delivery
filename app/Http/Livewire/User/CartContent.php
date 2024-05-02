<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Cart;

class CartContent extends Component
{
    public function refreshCartContent(){
        if(!empty(Cart::content())){
            // $this->emit('refreshCart');
            $this->render();
        }
        
    }

    public function render()
    {
        $items = Cart::content();
        $subTotal = Cart::subtotal();
        return view('livewire.user.cart-content', compact('items', 'subTotal'));
    }

    // public $listeners = [
    //     'refreshCart' => '$refresh'
    // ];


    public function removeItemFromCart($id){
        Cart::remove($id);
        $this->emit('itemCount');
    }

    public function increaseItemQty($rowId){
        $pro = Cart::get($rowId);
        $newQty = $pro->qty + 1;
        Cart::update($rowId, $newQty);
    }
    public function decreaseItemQty($rowId){
        $pro = Cart::get($rowId);
        $newQty = $pro->qty - 1;
        Cart::update($rowId, $newQty);
    }

    
}

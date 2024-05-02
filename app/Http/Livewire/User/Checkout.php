<?php

namespace App\Http\Livewire\User;

use App\Jobs\OrderConfirmationSms;
use App\Models\Order;
use App\Models\OrderedItem;
use App\Models\Payment;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use WireUi\Traits\Actions;

class Checkout extends Component
{
    use Actions;
    public $llocation;
    public $nnewLocation = false;

    public $location, $newLocation, $specialInstructions, $subTotal, $total;
    public $res = [];
    
    public function render()
    {
        $items = Cart::content();
        $subTotals = Cart::subtotal();
        // dd($subTotals);
        return view('livewire.user.checkout', compact('items', 'subTotals'));
    }

    public function showNewLocation(){
        $this->nnewLocation = true;
    }
    public function hideNewLocation(){
        $this->nnewLocation = false;
    }

    public function removeItemFromCart($id){
        Cart::remove($id);
        $this->emit('itemCount');
        $this->res = [];
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

    public function placeOrder(){

        // dd(Cart::content());
        
        foreach(Cart::content() as $order){
            //dd($order->options['restaurant_id']);
            array_push($this->res, $order->options['restaurant_id']);
            
        }

        // dd(reset($this->res));


        if(count(array_unique($this->res, SORT_REGULAR)) === 1){

            if(empty(Auth::check())){
                $this->dialog()->error(
                    $title = 'Error !!!',
                    $description = 'Please login in to continue'
                );
            }
    
            if(empty($this->location)){
                $this->nnewLocation = true;
            }
           
            $this->validate([
                'newLocation' => 'required_if:location,=,null',
                'location' => 'required_if:newLoction,=,null',
            ]);

            
            
            if(Auth::check()){
    
            // saving to orders
            $order = new Order();
            $order->user_id = Auth::user()->id;
            $order->sub_total = Cart::subtotal();
            $order->total = Cart::subtotal() + 5;
            $order->location = $this->location;
            $order->new_location = $this->newLocation;
            $order->special_instruction = $this->specialInstructions;
            $order->status = 4;
            $order->food_center_id = reset($this->res);
            
            $order->save();
    
            
            // saving to ordered type
            foreach(Cart::content() as $item){
                $orderedItem = new OrderedItem();
                $orderedItem->food_id = $item->id;
                $orderedItem->order_id = $order->id;
                $orderedItem->food_price = $item->price;
                $orderedItem->quantity = $item->qty;
                $orderedItem->save();
            }
    
            // saving to payment table
            $paymentType = new Payment();
            $paymentType->user_id = Auth::user()->id;
            $paymentType->order_id = $order->id;
            $paymentType->rider_id = 0;
            // $paymentType->mode = $this->payment_mode;
            $paymentType->save();
    
            $this->notification()->success(
                $title = 'your order has been placed successfully',
                $description = ''
            );
    
            
            //destroying cart after saving
            Cart::destroy();
    
            redirect()->route('thanks');
    
            //dispatching job to send order confirmation message
            $name = Auth::user()->name;
            $phoneNumber = Auth::user()->phone_number;
            OrderConfirmationSms::dispatch($order->id, $name, $phoneNumber);
            }
            else{
                $this->dialog()->error(
                    $title = 'Error !!!',
                    $description = 'Please login in to checkout'
                );
            }
        }
        else{
            $this->dialog()->error(
            $title = 'You cannot order from two different places / restaurants in the one order',
            $description = ''
            );
        }

        
        
    }

    

}

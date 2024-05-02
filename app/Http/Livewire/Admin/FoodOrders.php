<?php

namespace App\Http\Livewire\Admin;

use App\Jobs\AssignOrderSms;
use App\Models\Order;
use App\Models\OrderedItem;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class FoodOrders extends Component
{
    use WithPagination;
    use Actions;

    public $orderDetailsModal = false;
    public $items = [];
    public $subTotal;
    public $total;
    public $biker;
    public $chosenOrder;
    public $orderId;

    public function render()
    {
        $orders = Order::with(['getLocation', 'getBikerInfo', 'getCenterName'])->orderBy('created_at','desc')->paginate(15);
        return view('livewire.admin.food-orders', compact('orders'));
    }

    public function openOrderDetails(Order $orders){
        $this->orderId = $orders->id;
        $this->discardBikerInfo();

        $this->orderDetailsModal = true;
        
        $this->subTotal = $orders->sub_total;
        $this->total = $orders->total;

        $this->biker = $orders->assignee;

        $this->chosenOrder = $orders;

        $this->items = OrderedItem::with('getFoodDetails')->where('order_id', $orders->id)->get();
        
    }

    public function assignBiker(){

        $this->orderDetailsModal = false;

        $this->dialog()->confirm([
            'title'       => 'Are you Sure?',
            'description' => 'Save the information?',
            'acceptLabel' => 'Yes, save it',
            'method'      => 'bikerConfirmation',
            'params'      => 'Saved',
        ]);
    }

    public function bikerConfirmation(){
        $this->chosenOrder->assignee = $this->biker;
        $this->chosenOrder->save();

        //assign order sms to biker
        $biker = User::findOrFail($this->biker);
        $bikerName = $biker->name;
        $bikerPhoneNumber = $biker->phone_number;

        AssignOrderSms::dispatch($bikerName, $bikerPhoneNumber, $this->orderId);

        $this->orderId = '';

    }

    public function discardBikerInfo(){
        $this->biker = '';
    }

    
}

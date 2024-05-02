<?php

namespace App\Http\Livewire\User;

use App\Models\Order;
use App\Models\OrderedItem;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class OrderHistory extends Component
{
    use WithPagination;

    public $orderDetailsModal = false;
    public $orderId;
    public $orderStatus;
    public $subTotal;
    public $total;
    public $items = [];
    public $bikerPhoneNumber, $bikerImage, $bikerName;

    public $specialInstructions;
    public $centerName;

    public $location;
    public $newLocation;

    public $filterModal = false;
    public $search;
    public $delivery_statuses = '';
    public $startDate, $endDate;

    public function openFilterModal(){
        $this->filterModal = true;
    }

    public function resetFilters(){
        $this->search = '';
        $this->delivery_statuses = '';
        $this->startDate = '';
        $this->endDate = '';
    }

    public function render()
    {
        if($this->search != ''){
            $orders = Order::where('user_id', Auth::user()->id)
            ->where('id', $this->search)
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        }

        if($this->search == ''){
            $orders = Order::where('user_id', Auth::user()->id)->paginate(15);
        }

        if(!empty($this->delivery_statuses)){
            $orders = Order::where('user_id', Auth::user()->id)
            ->where('status', $this->delivery_statuses)
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        }

        if(!empty($this->startDate) & !empty($this->endDate)){
            $orders = Order::where('user_id', Auth::user()->id)
            ->whereBetween('created_at',[$this->startDate." 00:00:00", $this->endDate." 23:59:59"])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        }

        // $orders = Order::where('user_id', Auth::user()->id)->paginate(15);
        return view('livewire.user.order-history', compact('orders'));
    }

    public function openOrderDetailsModal($id){
        $this->discardBikerInfo();
        
        $this->orderDetailsModal = true;
        $order = Order::with(['getLocation','getBikerInfo', 'getCenterName'])->findOrFail($id);
        $this->orderId = $order->id;
        $this->subTotal = $order->sub_total;
        $this->total = $order->total;
        $this->orderStatus = $order->status;
        $this->items = OrderedItem::with('getFoodDetails')->where('order_id', $id)->get();

        //getting location info
        if(!empty($order->location)){
            $this->location = $order->getLocation->name;
        }
        $this->newLocation = $order->new_location;

        $this->specialInstructions = $order->special_instruction;
        $this->centerName = $order->getCenterName->name;

        if(!empty($order->assignee)){

            $this->bikerImage = $order->getBikerInfo->image;
            $this->bikerPhoneNumber = $order->getBikerInfo->phone_number;
            $this->bikerName = $order->getBikerInfo->name;
        }
        // dd($this->items);

    }

    public function discardBikerInfo(){
        $this->bikerImage = '';
        $this->bikerPhoneNumber = '';
        $this->bikerName = '';
    }
}

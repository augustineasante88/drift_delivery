<?php

namespace App\Http\Livewire\User;

use App\Jobs\OrderCancelednSms;
use App\Jobs\OrderCanceledSmsToBiker;
use App\Models\Order;
use App\Models\OrderedItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use WireUi\Traits\Actions;

class OrdersPage extends Component
{
    use Actions;

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
            // ->orWhere('status', 0)
            ->orderBy('created_at', 'desc')
            ->get(); 
        }

        if($this->search == ''){

            $orders = Order::where('user_id', Auth::user()->id)
            ->where('status', 4)
            ->orWhere('status', 2)
            ->orWhere('status', 3)
            // ->orWhere('status', 0)
            ->orderBy('created_at', 'desc')
            ->get();
        }

        if(!empty($this->delivery_statuses)){
            $orders = Order::where('status', $this->delivery_statuses)
            ->where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->get();
        }

        if(!empty($this->startDate) & !empty($this->endDate)){

            $orders = Order::where('user_id', Auth::user()->id)
            ->whereBetween('created_at',[$this->startDate." 00:00:00", $this->endDate." 23:59:59"])
            ->orderBy('created_at', 'desc')
            ->get();
        }


        // $orders = Order::where('user_id', Auth::user()->id)
        // ->where('status', 4)
        // ->orWhere('status', 2)
        // ->orWhere('status', 3)
        // // ->orWhere('status', 0)
        // ->orderBy('created_at', 'desc')
        // ->get();
        return view('livewire.user.orders-page', compact('orders'));
    }

    public function openOrderDetailsModal($id){
        $this->discardBikerInfo();

        $this->orderDetailsModal = true;
        $order = Order::with(['getLocation','getBikerInfo', 'getCenterName'])->findOrFail($id);
        $this->orderId = $order->id;
        $this->subTotal = $order->sub_total;

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

        $this->total = $order->total;
        $this->orderStatus = $order->status;
        $this->items = OrderedItem::with('getFoodDetails')->where('order_id', $id)->get();
        // dd($this->items);

    }

    public function cancelOrder($order){

        $this->dialog()->confirm([
            'title'       => 'Are you Sure?',
            'description' => '',
            'acceptLabel' => 'Yes, cancel it',
            'method'      => 'cancelConfirmed',
            'params'      => $order,
        ]);
        $this->orderDetailsModal = false;
        // $this->orderId = '';

    }

    public function cancelConfirmed(Order $order){
        $order->status = 1;
        $order->save();

        $this->render();

        // sending confirmation sms after ordering food
        $username = Auth::user()->name;
        $userPhoneNumber = Auth::user()->phone_number;
        OrderCancelednSms::dispatch($username, $order->id, $userPhoneNumber);

        // sending canceled sms to biker
        $user = $order->load('getBikerInfo');
        $username = $user->getBikerInfo->name;
        $userPhoneNumber = $user->getBikerInfo->phone_number;
        OrderCanceledSmsToBiker::dispatch($username, $order->id, $userPhoneNumber);
    }

    public function discardBikerInfo(){
        $this->bikerImage = '';
        $this->bikerPhoneNumber = '';
        $this->bikerName = '';
    }

    


}

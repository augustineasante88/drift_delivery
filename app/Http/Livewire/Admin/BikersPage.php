<?php

namespace App\Http\Livewire\Admin;

use App\Jobs\OrderArrivedSms;
use App\Jobs\OrderCancelednSms;
use App\Jobs\OrderCanceledSmsToBiker;
use App\Jobs\OrderCanceledSmsToUser;
use App\Jobs\OrderPickedupSms;
use App\Models\Order;
use App\Models\OrderedItem;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use WireUi\Traits\Actions;

class BikersPage extends Component
{
    use Actions;
    public $orderDetailsModal = false;
    public $orderId;
    public $orderStatus;
    public $subTotal;
    public $total;
    public $items = [];
    public $location;
    public $newLocation;
    public $username;
    public $phoneNumber;
    public $specialInstructions;
    public $centerName;

    public $filterModal = false;
    public $search;
    public $delivery_status = '';
    public $startDate, $endDate;

    public function openFilterModal(){
        $this->filterModal = true;
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


        // sending canceled sms to user
        $user = $order->load('getUserInfo');
        $username = $user->getUserInfo->name;
        $userPhoneNumber = $user->getUserInfo->phone_number;
        OrderCanceledSmsToUser::dispatch($username, $order->id, $userPhoneNumber);
        $this->render();
    }

    public function completeDelivery(){

        $this->orderDetailsModal = false;
        $this->dialog()->confirm([
            'title'       => 'Are you sure You want to confirm that You have successfully delivered the food?',
            'description' => '',
            'icon'        => 'question',
            'accept'      => [
                'label'  => 'Yes, confirm delivery',
                'method' => 'deliveryDone',
                'params' => '',
            ],
            'reject' => [
                'label'  => 'No, cancel',
                'method' => '',
            ],
        ]);

    }

    public function deliveryDone(){
        $order = Order::findOrFail($this->orderId);
        $order->status = 5;
        $order->save();

        $this->notification()->success(
            $title = 'Successfully saved',
            $description = ''
        );

        $this->render();

    }

    public function confirmArrival(){
        $this->orderDetailsModal = false;
        $this->dialog()->confirm([
            'title'       => 'Are you sure You want to confirm that You have arrived?',
            'description' => '',
            'icon'        => 'question',
            'accept'      => [
                'label'  => 'Yes, confirm arrival',
                'method' => 'saveArrivalConfirmation',
                'params' => '',
            ],
            'reject' => [
                'label'  => 'No, cancel',
                'method' => '',
            ],
        ]);
    }

    public function saveArrivalConfirmation(){
        // dd($this->orderId);
        $order = Order::findOrFail($this->orderId);
        $order->status = 3;
        $order->save();

        $this->notification()->success(
            $title = 'Successfully saved',
            $description = ''
        );

        //order arrival sms
        $username = $order->getUserInfo->name; 
        $phoneNumber = $order->getUserInfo->phone_number; 
        $orderId = $order->id; 
        OrderArrivedSms::dispatch($username, $phoneNumber, $orderId);

        $this->render();
        
    }

    public function confirmPickup(){
        $this->orderDetailsModal = false;

        $this->dialog()->confirm([
            'title'       => 'Are you sure You want to confirm this pickup?',
            'description' => '',
            'icon'        => 'question',
            'accept'      => [
                'label'  => 'Yes, confirm pickup',
                'method' => 'savePickupConfirmation',
                'params' => '',
            ],
            'reject' => [
                'label'  => 'No, cancel',
                'method' => '',
            ],
        ]);
    }

    public function savePickupConfirmation(){
        // dd($this->orderId);
        $order = Order::with('getUserInfo')->findOrFail($this->orderId);
        $order->status = 2;
        $order->save();

        $this->notification()->success(
            $title = 'Successfully saved',
            $description = ''
        );

        //dispatching order picked  up sms to user
        $username = $order->getUserInfo->name; 
        $phoneNumber = $order->getUserInfo->phone_number; 
        $orderId = $order->id; 
        OrderPickedupSms::dispatch($username, $phoneNumber, $orderId);
        
    }

    public function openOrderDetailsModal($id){
        //
        $this->location = '';

        $this->orderDetailsModal = true;
        $order = Order::with(['getLocation', 'getUserInfo', 'getCenterName'])->findOrFail($id);
        //getting location info
        if(!empty($order->location)){
            $this->location = $order->getLocation->name;
        }
        $this->newLocation = $order->new_location;
        $this->specialInstructions = $order->special_instruction;

        //getting user info
        $this->username = $order->getUserInfo->name;
        $this->phoneNumber = $order->getUserInfo->phone_number;

        // getting order info
        $this->orderId = $order->id;
        $this->subTotal = $order->sub_total;
        $this->centerName = $order->getCenterName->name;

        $this->total = $order->total;
        $this->orderStatus = $order->status;
        $this->items = OrderedItem::with('getFoodDetails')->where('order_id', $id)->get();
        // dd($this->items);


    }

    public function resetFilters(){
        $this->search = '';
        $this->delivery_status = '';
        $this->startDate = '';
        $this->endDate = '';
    }

    public function render()
    {
        if($this->search != ''){
            $assignedOrders = Order::with(['getLocation', 'getUserInfo'])->whereAssignee(Auth::user()->id)
            ->where('id', $this->search)
            ->get();   
        }

        if($this->search == ''){

            $assignedOrders = Order::with(['getLocation', 'getUserInfo'])->whereAssignee(Auth::user()->id)->get();
        }

        if(!empty($this->delivery_status)){
            $assignedOrders = Order::with(['getLocation', 'getUserInfo'])->whereAssignee(Auth::user()->id)
            ->where('status', $this->delivery_status)
            ->get();
        }

        if(!empty($this->startDate) & !empty($this->endDate)){
            $assignedOrders = Order::with(['getLocation', 'getUserInfo'])->whereAssignee(Auth::user()->id)
            ->whereBetween('created_at',[$this->startDate." 00:00:00", $this->endDate." 23:59:59"])
            ->get();
        }

        return view('livewire.admin.bikers-page', compact('assignedOrders'));
    }
}

<?php

namespace App\Http\Livewire\Admin;

use App\Models\FoodCentre;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class FoodCentres extends Component
{
    use WithPagination, WithFileUploads;

    public $addCenterModal;
    public $editCenterModal;
    public $name, $location, $phone_number, $image;
    public $storedImage;
    public $centerID;


    public function render()
    {
        $centers = FoodCentre::paginate(15);
        return view('livewire.admin.food-centres', compact('centers'));
    }

    public function clearFields(){
        $this->name= '';
        $this->location= '';
        $this->phone_number= '';
        $this->image= '';
        $this->storedImage= '';
        $this->centerID= '';
    }

    public function addCenter(){
        $this->validate([
            'name' => 'required',
            'location' => 'required',
            'phone_number' => 'required',
            'image' => 'required'
        ]);

        $center = new FoodCentre();
        $center->name = $this->name;
        $center->location = $this->location;
        $center->phone_number = $this->phone_number;

        // saving image
        if(!empty($this->image)){

            $imageHashName = $this->image->hashName();
            $center->image = $imageHashName;

            $this->image->store('public/center_pictures');

        }

        $center->save();

        $this->addCenterModal = false;

        $this->clearFields();


    }

    public function updateCenter(){
        $validateData = [
            'name' => 'required',
            'location' => 'required',
            'phone_number' => 'required',
            // 'image' => 'required'
        ];

       
        $data = [
        'name' => $this->name,
        'location' => $this->location,
        'phone_number' => $this->phone_number,
        ];

        // saving image
        if(!empty($this->image)){

            if(!empty($this->storedImage)){
                unlink("storage/center_pictures/".$this->storedImage);
            }

            $imageHashName = $this->image->hashName();

            $validateData = array_merge($validateData, [
                'image'=> 'image',
            ]);

            $data = array_merge($data,[
                'image' => $imageHashName,
            ]);
            

            $this->image->store('public/center_pictures');
            // $center->image = $imageHashName;
        }

        
        
        $this->validate($validateData);
        FoodCentre::findOrFail($this->centerID)->update($data);

        $this->editCenterModal = false;

        $this->clearFields();

    }


    public function openAddCenterModal(){
        $this->resetErrorBag();
        $this->clearFields();
        $this->addCenterModal = !$this->addCenterModal;
    }

    public function openEditCenterModal(FoodCentre $center){
        $this->resetErrorBag();
        $this->clearFields();
        $this->editCenterModal = !$this->editCenterModal;
        
        $this->centerID = $center->id;
        $this->name= $center->name;
        $this->location= $center->location;
        $this->phone_number= $center->phone_number;
        $this->storedImage= $center->image;
    }

    
}

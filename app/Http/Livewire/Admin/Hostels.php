<?php

namespace App\Http\Livewire\Admin;

use App\Models\Hostel;
use Livewire\Component;

class Hostels extends Component
{
    public $name;
    public $addHostelModal;

    public function render()
    {
        $hostels = Hostel::paginate(10);
        //dd($hostels);
        return view('livewire.admin.hostels', compact('hostels'));
    }

    public function clearFields(){
        $this->name= '';
    }

    public function addHostel(){
        $this->validate([
            'name' => 'required',
        ]);

        $center = new Hostel();
        $center->name = $this->name;
        $center->save();

        $this->addHostelModal = false;

        $this->clearFields();


    }

    public function openAddHostelModal(){
        $this->resetErrorBag();
        $this->clearFields();
        $this->addHostelModal = !$this->addHostelModal;
    }
}

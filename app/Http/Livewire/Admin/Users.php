<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class Users extends Component
{
    use WithFileUploads;
    public $name, $email, $location, $phone_number, $user_type, $image, $next_of_kin_name, $next_of_kin_phone_number;
    public $addUserModal;
    public function render()
    {
        $users = User::paginate(15);
        return view('livewire.admin.users', compact('users'));
    }

    public function clearFields(){
        $this->name= '';
        $this->location= '';
        $this->phone_number= '';
        $this->next_of_kin_name= '';
        $this->next_of_kin_phone_number= '';
        $this->image= '';
        $this->email= '';
        $this->user_type= '';
    }

    public function addUser(){
        $validateData = [
            'name' => 'required',
            'location' => 'required',
            'email' => 'required',
            'user_type' => 'required',
            'phone_number' => ['required', 'unique:users'],
        ];

        // $food = new Food();
        $data = [

            'name' => $this->name,
            'location' => $this->location,
            'phone_number' => $this->phone_number,
            'email' => $this->email,
            'password' => bcrypt('password'),
            'next_of_kin_name' => $this->next_of_kin_name,
            'next_of_kin_phone_number' => $this->next_of_kin_phone_number,
            'user_type' => $this->user_type
            // 'image' => $this->image,
        ];

        if(!empty($this->image)){

            $imageHashName = $this->image->hashName();
        

        $validateData = array_merge($validateData, [
            'image'=> 'image',
        ]);

        $data = array_merge($data,[
            'image' => $imageHashName,
        ]);

        $this->image->store('public/users_pictures');
        }

        $this->validate($validateData);

        User::create($data);

        $this->addUserModal = false;

        $this->clearFields();

    }

    public function openAddUserModal(){
        $this->resetErrorBag();
        $this->clearFields();
        $this->addUserModal = !$this->addUserModal;
    }
}

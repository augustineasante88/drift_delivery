<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\FoodCategory;
use App\Models\FoodCentre;
use App\Models\Hostel;
use App\Models\Order;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class FrontendController extends Controller
{
    //
    public function index(){
        
        $foodCenters = FoodCentre::all();
        return view('new-home', compact('foodCenters' ));
    }

    public function getDetails(FoodCentre $center){
        //dd($center);
        // session(['restaurant_name' => $center->name]);
        $categories = FoodCategory::all();
        return view('frontend.details', compact('center', 'categories'));
    }

    public function getOrders(){
        return view('frontend.orders');
    }
    public function getOrdersHistory(){
        return view('frontend.order-history');
    }
    public function getProfile(){
        
        return view('frontend.profile');
    }
    public function getUserDashboard(){
        $orderCount = Order::where('user_id', Auth::user()->id)
        ->where('status', 4)
        ->orWhere('status', 2)
        ->count();
        return view('frontend.user-dashboard', compact('orderCount'));
    }
    public function getCheckout(){
        return view('frontend.checkout');
    }
    public function getThankYouPage(){
        return view('frontend.thanks');
    }
    public function getEatingPlaces(){
        return view('frontend.restaurants');
    }

    public function getLocations(Request $request){

        return Hostel::query()
            ->select('id', 'name')
            ->orderBy('name')
            ->when(
                $request->search,
                fn (Builder $query) => $query
                    ->where('name', 'like', "%{$request->search}%")
            )
            ->when(
                $request->exists('selected'),
                fn (Builder $query) => $query->whereIn('id', $request->input('selected', [])),
                fn (Builder $query) => $query->limit(10)
            )
            ->get();
    }

    public function getBikers(Request $request){

        return User::query()
            ->where('user_type', '=', 2)
            ->select('id', 'name')
            ->orderBy('name')
            ->when(
                $request->search,
                fn (Builder $query) => $query
                    ->where('name', 'like', "%{$request->search}%")
            )
            ->when(
                $request->exists('selected'),
                fn (Builder $query) => $query->whereIn('id', $request->input('selected', [])),
                fn (Builder $query) => $query->limit(10)
            )
            ->get();
    }

    public function redirect(){
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback(){

        // dd( $google_user = Socialite::driver('google')->stateless()->user());

        try{
            $google_user = Socialite::driver('google')->stateless()->user();

            $user = User::where('google_id', $google_user->getId())->first();

            if(!$user){
                $new_user = User::create([
                    'name' => $google_user->getName(),
                    'email' => $google_user->getEmail(),
                    'google_id' => $google_user->getId()
                ]);

                Auth::login($new_user);
                return redirect()->intended('user-dashboard');
            }
            else{
                Auth::login($user);
                return redirect()->intended('user-dashboard');
            }

        }
        catch(Exception $e ){
            dd('error'. $e->getMessage());
        }

    }

    public function updateProfile(UpdateProfileRequest $request, User $user){
       
    
        $user->update($request->all());

        return redirect('/profile')->withSuccess('success message');
    }

    public function updatePassword(Request $request, User $user){
       $this->validate($request,[
        'old_password' => 'required',
        'password' => 'required|confirmed'
       ]);

       if(Hash::check($request->old_password, $user->password)){
        $user->password = Hash::make($request->password);
        $user->save();

        // Auth::login($user, !!$user->getRememberToken());
        auth()->setUser($user);

        return redirect('/profile')->withInfo('success message');
       }
       else{
        return back()->with('warning', "old password is wrong");
       }

    //    return redirect('/profile')->withSuccess('success message');

    }

    
}

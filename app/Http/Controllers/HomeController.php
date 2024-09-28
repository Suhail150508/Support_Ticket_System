<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Stmt\TryCatch;

class HomeController extends Controller
{
    public function login(){
        return view('/login');
    }
    public function loginStore(Request $request){

        $user = User::where('email',$request->email)->first();

        if($user && $user->role === 'admin'){

            Session()->put('user',$user);
            $tickets = Ticket::paginate(15);
            Toastr::success('Admin logged in successfully', 'Title', ["positionClass" => "toast-top-right"]);
            return view('admin.dashboard', compact('tickets'));
        }
        elseif($user && $user->role === 'customer'){

            Session()->put('user',$user);
            $user = User::with('tickets')->find($user->id);
            $tickets = $user->tickets()->paginate(15);

            Toastr::success('Customer logged in successfully', 'Title', ["positionClass" => "toast-top-right"]);
            return view('customer.dashboard', compact('tickets'));
        }else{

            Toastr::success('Credentials does not match', 'Title', ["positionClass" => "toast-top-right"]);
            return redirect()->to('/login');

        }
    }
    public function register(){
        return view('register');
    }
    public function registerStore(Request $request){

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:6|',
            'role' => 'required|in:admin,customer',
        ]);
    try{
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->save();

        Toastr::success('User Registered Successfully', 'Title', ["positionClass" => "toast-top-right"]);
        return redirect()->route('login');
    } catch (\Exception $e) {
        Toastr::success('Error has found', 'Title', ["positionClass" => "toast-top-right"]);
        return redirect('/');
    }
    }
    public function logout(){

        Session::flush();

    Toastr::success(' logged out successfully', 'Title', ["positionClass" => "toast-top-right"]);
    return redirect('/');
    }
}

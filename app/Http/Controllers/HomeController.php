<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        return redirect('dashboard');
    }

    public function viewDashboard(){
        $user = Auth::user();
        if($user->role == 'Admin'){
            return view('dashboard', compact(['user']))->with('_page', 'dashboard');
        } else if($user->role == 'Registrar'){ 
            return view('registrar-dashboard', compact(['user']))->with('_page', 'dashboard');
        }
    }

    public function samplePageRegistrar(){
        $user = Auth::user();
        return view('sample-page', compact(['user']))->with('_page', 'sample page');
    }

    public function profile(){
        $user = Auth::user();
        return view('profile', compact(['user']))->with('_page', 'profile');
    }

    public function StudentManagement(){
        $user = Auth::user();
        return view('StudentManagement', compact(['user']))->with('_page', 'Student Management');
    }

    public function StudentList(){
        $user = Auth::user();
        return view('Student-List', compact(['user']))->with('_page', 'Student List');
    }

    public function Shiftee(){
        $user = Auth::user();
        return view('Shiftee', compact(['user']))->with('_page', 'Shiftee');
    }

    public function CrossEnroll(){
        $user = Auth::user();
        return view('Cross-Enroll', compact(['user']))->with('_page', 'Shiftee');
    }


    public function transferee(){
        $user = Auth::user();
        return view('session.transferee', compact(['user']))->with('_page', 'Shiftee');
    }
    
}


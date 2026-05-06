<?php
// app/Http/Controllers/HomeController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function welcome()
    {
        // إذا كان المستخدم مسجل الدخول، نوجهه للـ dashboard
        if (auth()->check()) {
            return redirect()->route('dashboard');
        }
        
        return view('welcome');
    }
}
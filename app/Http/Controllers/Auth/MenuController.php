<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
class MenuController extends Controller
{
    /**
     * Display the menu view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('auth.menu'); // Asegúrate de que la vista esté en 'resources/views/auth/menu.blade.php'
    }
}

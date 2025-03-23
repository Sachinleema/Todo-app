<?php

namespace App\Controllers;
use CodeIgniter\Controller;

class Dashboard extends Controller
{
  public function index()
  {
    if (!session()->get('user_id')) {
      return redirect()->to('/login')->with('error', 'You must log in first.');
    }
    return view('dashboard');
  }
}

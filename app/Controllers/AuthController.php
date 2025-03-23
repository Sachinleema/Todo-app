<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AuthController extends BaseController
{
  public function login()
  {
    return view('auth/login');
  }

  public function register()
  {
    return view('auth/register');
  }

  public function dashboard()
  {
    $session = session();
    $userId = $session->get('user_id');

    $todoModel = new \App\Models\TodoModel();
    $data['todos'] = $todoModel->where('user_id', $userId)->findAll();

    return view('dashboard', $data);
  }


  // Register User
  public function registerUser()
  {
    $userModel = new UserModel();

    // Validate input
    $validation = \Config\Services::validation();
    $validation->setRules([
      'name' => 'required|min_length[3]',
      'email' => 'required|valid_email|is_unique[users.email]',
      'password' => 'required|min_length[6]',
    ]);

    if (!$this->validate($validation->getRules())) {
      return redirect()->back()->with('error', 'Validation failed')->withInput();
    }

    // Insert user into DB
    $userModel->save([
      'name' => $this->request->getPost('name'),
      'email' => $this->request->getPost('email'),
      'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
    ]);

    return redirect()->to('/login')->with('success', 'Registration successful. Please log in.');
  }

  // Login User
  public function loginUser()
  {
    $session = session();
    $userModel = new UserModel();
    $email = $this->request->getPost('email');
    $password = $this->request->getPost('password');

    $user = $userModel->where('email', $email)->first();

    if ($user && password_verify($password, $user['password'])) {
      // ✅ Set session values
      $session->set([
        'logged_in' => true,
        'user_id' => $user['id'],
        'user_name' => $user['name'],
      ]);

      return redirect()->to('/dashboard')->with('success', 'Login successful.');
    } else {
      return redirect()->back()->with('error', 'Invalid email or password');
    }
  }



  // Logout User
  public function logout()
  {
    session()->destroy();
    return redirect()->to('/login')->with('success', 'Logged out successfully.');
  }
}

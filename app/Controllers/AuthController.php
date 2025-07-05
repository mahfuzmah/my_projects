<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class AuthController extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function processLogin()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
    
        $userModel = new \App\Models\UserModel();
        $user = $userModel->where('username', $username)->first();
    
        if ($user && password_verify($password, $user['password'])) {
            session()->set([
                'logged_in' => true,
                'username'  => $user['username'],
                'user_id'   => $user['id'],
                'role'      => $user['role'], 
            ]);
    
            return ($user['role'] === 'admin') 
                ? redirect()->to('/employees') 
                : redirect()->to('/attendance');
        }
    
        return redirect()->back()->with('error', 'Invalid credentials');
    }
    
    

    public function register()
    {
        return view('auth/register');
    }

    public function processRegister()
    {
        $userModel = new \App\Models\UserModel();

        $data = [
            'username'     => $this->request->getPost('username'),
            'password'     => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'         => 'employee', // Default role
            'name'         => $this->request->getPost('name'),
            'gender'       => $this->request->getPost('gender'),
            'job_type'   => $this->request->getPost('job_type'),
            'joined_date'  => $this->request->getPost('joined_date'),
            'email'        => $this->request->getPost('email'),
        ];

        $picture = $this->request->getFile('picture');
        if ($picture && $picture->isValid() && !$picture->hasMoved()) {
            $newName = $picture->getRandomName();
            $picture->move('uploads/', $newName);
            $data['picture'] = $newName;
        }

        $userModel->save($data);

        return redirect()->to('/employees')->with('success', 'Employee registered successfully.');
    }


    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}

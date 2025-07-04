<?php

namespace App\Controllers;

use App\Models\EmployeeModel;

class Employee extends EmployeeBaseController
{
    public function index()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/attendance')->with('error', 'Unauthorized access');
        }
        
        $model = new EmployeeModel();
        $data['employees'] = $model->findAll();
        return view('employee_list', $data);
    }

    // ✅ Correct placement: inside the class
    public function create()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/attendance')->with('error', 'Unauthorized access');
        }
        
        return view('employee_create');
    }

    public function store()
    {
        $model = new EmployeeModel();

        // Get data from POST
        $data = [
            'name'     => $this->request->getPost('name'),
            'email'    => $this->request->getPost('email'),
            'position' => $this->request->getPost('position'),
        ];

        // Insert into DB
        $model->insert($data);

        // Redirect to employee list
        return redirect()->to('/employees');
    }

        // Show Edit Form
    public function edit($id)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/attendance')->with('error', 'Unauthorized access');
        }
        
        $model = new EmployeeModel();
        $data['employee'] = $model->find($id);

        if (!$data['employee']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Employee not found');
        }

        return view('employee_edit', $data);
    }

    // Handle Form Submission (Update)
    public function update($id)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/attendance')->with('error', 'Unauthorized access');
        }
        
        $model = new EmployeeModel();

        $data = [
            'name'     => $this->request->getPost('name'),
            'email'    => $this->request->getPost('email'),
            'position' => $this->request->getPost('position'),
        ];

        $model->update($id, $data);

        return redirect()->to('/employees');
    }

    public function delete($id)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/attendance')->with('error', 'Unauthorized access');
        }
        
        $model = new \App\Models\EmployeeModel();
        $model->delete($id);

        return redirect()->to('/employees')->with('message', 'Employee deleted successfully.');
    }


}

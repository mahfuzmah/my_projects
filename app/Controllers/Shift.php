<?php

namespace App\Controllers;
use App\Models\ShiftModel;

class Shift extends BaseController
{
    public function index()
    {
        // Only allow admin
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard'); // or show 403
        }

        $model = new ShiftModel();
        $data['shifts'] = $model->findAll();
        return view('shift_list', $data);
    }

    public function create()
    {
        $model = new \App\Models\ShiftModel();
        $model->insert([
            'name' => $this->request->getPost('name'),
            'start_time' => $this->request->getPost('start_time'),
            'end_time' => $this->request->getPost('end_time'),
        ]);
        return redirect()->to('employees/shifts');
    }


}

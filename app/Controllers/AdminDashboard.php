<?php

namespace App\Controllers;

use App\Models\EmployeeModel;
use App\Models\AttendanceModel;

class AdminDashboard extends BaseController
{
    public function index()
    {
        $employeeModel = new EmployeeModel();
        $attendanceModel = new AttendanceModel();

        $data = [
            'totalEmployees' => $employeeModel->countAll(),
            'todayAttendance' => $attendanceModel
                ->where('DATE(clock_in)', date('Y-m-d'))
                ->countAllResults()
        ];

        return view('admin/dashboard', $data);
    }
}

<?php

namespace App\Controllers;

use App\Models\EmployeeModel;
use App\Models\AttendanceModel;

class AdminDashboard extends BaseController
{
    public function index()
    {
        // Optional: Load models to gather stats
        $employeeModel = new EmployeeModel();
        $attendanceModel = new AttendanceModel();

        // Example stats (these will show on dashboard)
        $data = [
            'totalEmployees' => $employeeModel->countAll(),
            'todayAttendance' => $attendanceModel
                ->where('DATE(clock_in)', date('Y-m-d'))
                ->countAllResults()
        ];

        // Load view with data
        return view('admin/dashboard', $data);
    }
}

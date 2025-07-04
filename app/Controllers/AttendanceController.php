<?php
namespace App\Controllers;

use App\Models\AttendanceModel;

class AttendanceController extends BaseController
{
    /*public function index()
    {
        $attendanceModel = new AttendanceModel();
        $userId = session()->get('user_id');

        // Get latest record for this user
        $lastRecord = $attendanceModel
                        ->where('user_id', $userId)
                        ->orderBy('id', 'DESC')
                        ->first();

        return view('attendance', ['lastRecord' => $lastRecord]);
    }*/

    public function index()
    {
        $user_id = session()->get('user_id');

        $attendanceModel = new \App\Models\AttendanceModel();

        // Get last attendance record
        $lastRecord = $attendanceModel->where('user_id', $user_id)->orderBy('id', 'DESC')->first();

        if ($lastRecord && !$lastRecord['clock_out']) {
            $status = 'clocked_in';
            $attendance_id = $lastRecord['id'];
        } else {
            $status = 'not_clocked_in';
            $attendance_id = null;
        }

        // Get all attendance history for the user
        $history = $attendanceModel->where('user_id', $user_id)->orderBy('id', 'DESC')->findAll();

        return view('attendance', [
            'status' => $status,
            'attendance_id' => $attendance_id,
            'history' => $history
        ]);
    }


    public function clockIn()
    {
        log_message('error', '✅ Clock-in endpoint was hit');
    
        $attendanceModel = new \App\Models\AttendanceModel();
        $userId = session()->get('user_id');
        log_message('error', '🔑 User ID from session: ' . print_r($userId, true));
    
        if (!$userId) {
            log_message('error', '❌ User not logged in');
            return $this->response->setJSON(['status' => 'not_logged_in']);
        }
    
        // Check if already clocked in
        $existing = $attendanceModel
            ->where('user_id', $userId)
            ->where('clock_out', null)
            ->first();
    
        if ($existing) {
            log_message('error', '⛔ User already clocked in');
            return $this->response->setJSON(['status' => 'already_clocked_in']);
        }
    
        // Parse raw JSON body
        $body = $this->request->getBody();
        log_message('error', '📦 Raw body: ' . $body);
    
        $input = json_decode($body, true);
        log_message('error', '📄 Parsed JSON: ' . print_r($input, true));
    
        if (!isset($input['lat']) || !isset($input['lon'])) {
            log_message('error', '❌ Missing latitude or longitude');
            return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid location data']);
        }
    
        $location = $input['lat'] . ', ' . $input['lon'];
    
        // Save to DB
        $attendanceModel->save([
            'user_id' => $userId,
            'clock_in' => date('Y-m-d H:i:s'),
            'clock_in_location' => $location
        ]);
    
        log_message('error', '✅ Clock-in recorded successfully');
    
        return $this->response->setJSON(['status' => 'success']);
    }

    public function clockOut($id)
    {
        $attendanceModel = new AttendanceModel();
        $record = $attendanceModel->find($id);
    
        if (!$record || $record['clock_out']) {
            return $this->response->setJSON(['status' => 'invalid']);
        }
    
        $input = json_decode($this->request->getBody(), true);
        $location = $input['lat'] . ', ' . $input['lon'];
    
        $attendanceModel->update($id, [
            'clock_out' => date('Y-m-d H:i:s'),
            'clock_out_location' => $location
        ]);
    
        return $this->response->setJSON(['status' => 'success']);
    }
    
    


    public function report()
    {
        $attendanceModel = new \App\Models\AttendanceModel();
        $db = \Config\Database::connect();
        $builder = $db->table('attendance');
        $builder->select('attendance.*, users.username, users.id as user_id');
        $builder->join('users', 'users.id = attendance.user_id');
        $builder->orderBy('attendance.clock_in', 'desc');
        $records = $builder->get()->getResultArray();
    
        return view('attendance/report', ['records' => $records]);
    }
    


}

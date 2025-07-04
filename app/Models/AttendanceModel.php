<?php

namespace App\Models;
use CodeIgniter\Model;

class AttendanceModel extends Model
{
    protected $table = 'attendance';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'clock_in', 'clock_in_location', 'clock_out', 'clock_out_location'];
    public $timestamps = false;
}

<?php

namespace App\Models;
use CodeIgniter\Model;

class ShiftModel extends Model
{
    protected $table = 'shifts';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'start_time', 'end_time'];
}

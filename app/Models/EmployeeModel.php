<?php

namespace App\Models;

use CodeIgniter\Model;

class EmployeeModel extends Model
{
    //protected $table = 'employees';
    //protected $primaryKey = 'id';
    //protected $allowedFields = ['name', 'email', 'position'];
    protected $table = 'users';

    protected $allowedFields = [
    'username', 'email', 'password', 'role', 'picture',
    'name', 'gender', 'department', 'joined_date'];
    protected $useTimestamps = false;
    protected $returnType = 'array';
}

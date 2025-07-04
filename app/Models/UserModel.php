<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';

    protected $allowedFields = [
    'username', 'email', 'password', 'role', 'picture',
    'name', 'gender', 'job_type', 'joined_date'];
    protected $useTimestamps = false;
    protected $returnType = 'array';

}

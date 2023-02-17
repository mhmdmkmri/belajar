<?php

namespace App\Models;

use CodeIgniter\Model;

class Dummy extends Model
{
    protected $table = 'dummy';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $createdField = 'created_at';

    protected $allowedFields = [
        'id',
        'name',
        'created_at'
    ];

}
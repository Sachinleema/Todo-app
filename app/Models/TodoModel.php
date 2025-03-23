<?php

namespace App\Models;
use CodeIgniter\Model;

class TodoModel extends Model
{
  protected $table = 'todos';
  protected $primaryKey = 'id';
  protected $allowedFields = ['user_id', 'task', 'created_at'];
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remark extends Model
{
    protected $fillable = ['employee_id', 'remark'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
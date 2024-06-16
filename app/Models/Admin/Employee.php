<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'employees';
    protected $fillable = [
        'ho', 'ten', 'ngaysinh', 'gioitinh', 'diachi', 'dienthoai', 'user_id'
    ];

    // Định nghĩa mối quan hệ belongsTo với bảng users
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }
}

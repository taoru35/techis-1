<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    // Mass assignmentのための設定
    protected $fillable = [
        'user_id',
        'full_name',
        'address',
        'phone_number',
    ];

    /**
     * ユーザーとのリレーションを定義
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

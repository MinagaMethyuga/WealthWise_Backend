<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accounts extends Model
{
    protected $fillable = [
        'user_id',
        'account_name',
        'account_nickName',
        'account_balance'
    ];
}

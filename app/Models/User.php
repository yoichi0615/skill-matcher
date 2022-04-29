<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';
    public $timestamps = true;

    protected $guarded = [
        'id',
    ];

    const PRINTING_FLG_YES = 1;
    const PRINTING_FLG_NO = 0;
    const WITHDRAWAL_FLG_YES = 1;
    const WITHDRAWAL_FLG_NO = 0; 

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}

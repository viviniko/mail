<?php

namespace Viviniko\Mail\Models;

use Viviniko\Support\Database\Eloquent\Model;

class User extends Model
{
    protected $tableConfigKey = 'mail.virtual_users_table';

    public $timestamps = false;

    protected $fillable = [
        'domain_id', 'email', 'password', 'role',
    ];

    public function domain()
    {
        return $this->belongsTo(Domain::class, 'domain_id');
    }

    public function setPasswordAttribute($password)
    {
        $salt = substr(sha1(rand()), 0, 16);
        $this->attributes['password'] = crypt($password, "$6$$salt");
    }

}

<?php

namespace Viviniko\Mail\Models;

use Viviniko\Support\Database\Eloquent\Model;

class Domain extends Model
{
    protected $tableConfigKey = 'mail.virtual_domains_table';

    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

    public function aliases()
    {
        return $this->hasMany(Alias::class, 'domain_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'domain_id');
    }

}

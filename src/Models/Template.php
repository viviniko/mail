<?php

namespace Viviniko\Mail\Models;

use Viviniko\Support\Database\Eloquent\Model;

class Template extends Model
{
    protected $tableConfigKey = 'mail.templates_table';

    protected $fillable = [
        'group', 'key', 'name', 'subject', 'content', 'from'
    ];

}

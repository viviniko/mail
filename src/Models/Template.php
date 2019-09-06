<?php

namespace Viviniko\Mail\Models;

use Viviniko\Support\Database\Eloquent\Model;

class Template extends Model
{
    protected $tableConfigKey = 'mail.tables.templates_table';

    protected $fillable = [
        'group', 'key', 'name', 'subject', 'content', 'from'
    ];

}

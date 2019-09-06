<?php

namespace Viviniko\Mail\Models;

use Viviniko\Support\Database\Eloquent\Model;

class Alias extends Model
{
    protected $tableConfigKey = 'mail.tables.virtual_aliases_table';

    public $timestamps = false;

    protected $fillable = [
        'domain_id', 'source', 'destination',
    ];

    public function domain()
    {
        return $this->belongsTo(Domain::class, 'domain_id');
    }
}

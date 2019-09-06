<?php

namespace Viviniko\Mail\Repositories\Alias;

use Illuminate\Support\Facades\Config;
use Viviniko\Repository\EloquentRepository;
use Illuminate\Support\Facades\DB;

class EloquentAlias extends EloquentRepository implements AliasRepository
{
    public function __construct()
    {
        parent::__construct(Config::get('mail.models.alias'));
    }

    /**
     * {@inheritdoc}
     */
    public function updateDomain($domainId, $oldName, $newName) {
        if ($newName && $oldName != $newName) {
            $this->createModel()->newQuery()->where('domain_id', $domainId)->update([
                'source' => DB::raw("replace(source, '@$oldName', '@$newName')"),
                'destination' => DB::raw("replace(destination, '@$oldName', '@$newName')")
            ]);
        }
    }
}
<?php

namespace Viviniko\Mail\Repositories\Alias;

use Viviniko\Repository\SimpleRepository;
use Illuminate\Support\Facades\DB;

class EloquentAlias extends SimpleRepository implements AliasRepository
{
    use ValidatesAliasData;

    protected $modelConfigKey = 'mail.alias';

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
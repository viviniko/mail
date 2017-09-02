<?php

namespace Viviniko\Mail\Repositories\User;

use Viviniko\Repository\SimpleRepository;
use Illuminate\Support\Facades\DB;

class EloquentUser extends SimpleRepository implements UserRepository
{
    use ValidatesUserData;

    protected $modelConfigKey = 'mail.user';

    /**
     * {@inheritdoc}
     */
    public function updateDomain($domainId, $oldName, $newName)
    {
        if ($newName && $oldName != $newName) {
            $this->createModel()->newQuery()->where('domain_id', $domainId)->update(['email' => DB::raw("replace(email, '@$oldName', '@$newName')")]);
        }
    }
}
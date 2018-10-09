<?php

namespace Viviniko\Mail\Repositories\User;

use Illuminate\Support\Facades\Config;
use Viviniko\Repository\EloquentRepository;
use Illuminate\Support\Facades\DB;

class EloquentUser extends EloquentRepository implements UserRepository
{
    public function __construct()
    {
        parent::__construct(Config::get('mail.user'));
    }

    /**
     * {@inheritdoc}
     */
    public function updateDomain($domainId, $oldName, $newName)
    {
        if ($newName && $oldName != $newName) {
            $this->createQuery()->where('domain_id', $domainId)->update(['email' => DB::raw("replace(email, '@$oldName', '@$newName')")]);
        }
    }
}
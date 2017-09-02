<?php

namespace Viviniko\Mail\Repositories\User;

interface UserRepository
{
    /**
     * Update user email domain.
     *
     * @param $domainId
     * @param $oldName
     * @param $newName
     * @return mixed
     */
    public function updateDomain($domainId, $oldName, $newName);
}
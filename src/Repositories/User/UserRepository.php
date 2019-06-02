<?php

namespace Viviniko\Mail\Repositories\User;

use Viviniko\Repository\CrudRepository;

interface UserRepository extends CrudRepository
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
<?php

namespace Viviniko\Mail\Repositories\User;

interface UserRepository
{
    /**
     * Get all data.
     *
     * @return \Illuminate\Support\Collection
     */
    public function all();

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
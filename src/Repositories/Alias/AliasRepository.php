<?php

namespace Viviniko\Mail\Repositories\Alias;

interface AliasRepository
{
    /**
     * Get all data.
     *
     * @return \Illuminate\Support\Collection
     */
    public function all();

    /**
     * Update alias domain.
     *
     * @param $domainId
     * @param $oldName
     * @param $newName
     * @return mixed
     */
    public function updateDomain($domainId, $oldName, $newName);
}
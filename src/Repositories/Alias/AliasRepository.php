<?php

namespace Viviniko\Mail\Repositories\Alias;

interface AliasRepository
{
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
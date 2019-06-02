<?php

namespace Viviniko\Mail\Repositories\Alias;

use Viviniko\Repository\CrudRepository;

interface AliasRepository extends CrudRepository
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
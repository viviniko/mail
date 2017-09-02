<?php

namespace Viviniko\Mail\Repositories\Domain;

interface DomainRepository
{
    /**
     * Lists all system domains into $key => $column value pairs.
     *
     * @param string $column
     * @param string $key
     * @return mixed
     */
    public function pluck($column = 'name', $key = 'id');

    /**
     * Find domain by name.
     *
     * @param $name
     * @return null|Domain
     */
    public function findByName($name);
}
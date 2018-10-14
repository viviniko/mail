<?php

namespace Viviniko\Mail\Repositories\Domain;

interface DomainRepository
{
    /**
     * Get all data.
     *
     * @return \Illuminate\Support\Collection
     */
    public function all();

    /**
     * Lists all system domains into $key => $column value pairs.
     *
     * @param string $column
     * @param string $key
     * @return mixed
     */
    public function pluck($column, $key = null);

    /**
     * Find domain by name.
     *
     * @param $name
     * @return null|Domain
     */
    public function findByName($name);
}
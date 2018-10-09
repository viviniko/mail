<?php

namespace Viviniko\Mail\Repositories\Domain;

use Illuminate\Support\Facades\Config;
use Viviniko\Repository\EloquentRepository;

class EloquentDomain extends EloquentRepository implements DomainRepository
{
    public function __construct()
    {
        parent::__construct(Config::get('mail.domain'));
    }

    /**
     * {@inheritdoc}
     */
    public function findByName($name) {
        return $this->findBy('name', $name);
    }

    /**
     * {@inheritdoc}
     */
    public function pluck($column = 'name', $key = 'id') {
        return $this->pluck($column, $key);
    }

}
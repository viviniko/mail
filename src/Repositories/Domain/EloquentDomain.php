<?php

namespace Viviniko\Mail\Repositories\Domain;

use Illuminate\Support\Facades\Config;
use Viviniko\Repository\EloquentRepository;

class EloquentDomain extends EloquentRepository implements DomainRepository
{
    public function __construct()
    {
        parent::__construct(Config::get('mail.models.domain'));
    }

    /**
     * {@inheritdoc}
     */
    public function findByName($name) {
        return $this->findBy('name', $name);
    }
}
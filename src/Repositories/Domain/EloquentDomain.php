<?php

namespace Viviniko\Mail\Repositories\Domain;

use Viviniko\Repository\SimpleRepository;

class EloquentDomain extends SimpleRepository implements DomainRepository
{
    use ValidatesDomainData;

    protected $modelConfigKey = 'mail.domain';

    /**
     * {@inheritdoc}
     */
    public function findByName($name) {
        return $this->findBy('name', $name)->first();
    }

    /**
     * {@inheritdoc}
     */
    public function pluck($column = 'name', $key = 'id') {
        return $this->createModel()->newQuery()->pluck($column, $key);
    }

}
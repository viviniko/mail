<?php

namespace Viviniko\Mail\Repositories\Template;

use Viviniko\Repository\SimpleRepository;

class EloquentTemplate extends SimpleRepository implements TemplateRepository
{
    use ValidatesTemplateData;

    protected $modelConfigKey = 'mail.template';

    /**
     * {@inheritdoc}
     */
    public function findByKey($key)
    {
        return $this->findBy('key', $key)->first();
    }
}
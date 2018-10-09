<?php

namespace Viviniko\Mail\Repositories\Template;

interface TemplateRepository
{
    public function find($id);

    /**
     * Get mail template by key.
     *
     * @param string $key
     * @return null|Template
     */
    public function findByKey($key);
}
<?php

namespace Viviniko\Mail\Repositories\Template;

interface TemplateRepository
{
    /**
     * Get mail template by key.
     *
     * @param string $key
     * @return null|Template
     */
    public function findByKey($key);
}
<?php

namespace Viviniko\Mail\Repositories\Template;

use Illuminate\Support\Facades\Config;
use Viviniko\Repository\EloquentRepository;

class EloquentTemplate extends EloquentRepository implements TemplateRepository
{
    public function __construct()
    {
        parent::__construct(Config::get('mail.template'));
    }
}
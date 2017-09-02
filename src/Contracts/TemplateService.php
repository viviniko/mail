<?php

namespace Viviniko\Mail\Contracts;

use Viviniko\Mail\Exceptions\MailTemplateNotFoundException;
use Illuminate\Mail\Mailable;

interface TemplateService
{
    /**
     * Get mail message.
     *
     * @param  mixed  $key
     * @param  array  $data
     * @return  null|Mailable
     * @throws MailTemplateNotFoundException
     */
    public function makeMail($key, $data);
}
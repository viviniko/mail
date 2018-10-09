<?php

namespace Viviniko\Mail\Services;

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
<?php

namespace Viviniko\Mail\Services;

use Viviniko\Mail\Exceptions\MailTemplateNotFoundException;
use Illuminate\Mail\Mailable;

interface TemplateService
{
    /**
     * Get all templates
     *
     * @return \Illuminate\Support\Collection
     */
    public function templates();

    /**
     * Get template.
     *
     * @param $id
     * @return mixed
     */
    public function getTemplate($id);

    /**
     * @param array $data
     * @return mixed
     */
    public function createTemplate(array $data);

    public function updateTemplate($id, array $data);

    public function deleteTemplate($id);

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
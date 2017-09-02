<?php

namespace Viviniko\Mail\Repositories\Template;

use Viviniko\Support\ValidatesData;

trait ValidatesTemplateData
{
    use ValidatesData;

    public function validateCreateData($data)
    {
        $this->validate($data, $this->rules());
    }

    public function validateUpdateData($templateId, $data)
    {
        $this->validate($data, $this->rules($templateId));
    }

    public function rules($templateId = null)
    {
        $templateId = is_null($templateId) ? '' : ',' . $templateId;
        return [
            'name' => 'required',
            'subject' => 'required',
            'content' => 'required',
            'key' => 'required|unique:' . config('mail.templates_table') . ',key' . $templateId
        ];
    }
}
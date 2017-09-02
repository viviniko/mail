<?php

namespace Viviniko\Mail\Repositories\Domain;

use Viviniko\Support\ValidatesData;

trait ValidatesDomainData
{
    use ValidatesData;

    public function validateCreateData($data)
    {
        $this->validate($data, $this->rules());
    }

    public function validateUpdateData($domainId, $data)
    {
        $this->validate($data, $this->rules($domainId));
    }

    public function rules($domainId = null)
    {
        $domainId = is_null($domainId) ? '' : ',' . $domainId;
        return [
            'name' => 'required|unique:' . config('mail.virtual_domains_table') . ',name' . $domainId
        ];
    }
}
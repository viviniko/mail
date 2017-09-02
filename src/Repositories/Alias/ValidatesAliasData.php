<?php

namespace Viviniko\Mail\Repositories\Alias;

use Viviniko\Support\ValidatesData;

trait ValidatesAliasData
{
    use ValidatesData;

    public function validateCreateData($data)
    {
        $this->validate($data, $this->rules());
    }

    public function validateUpdateData($aliasId, $data)
    {
        $this->validate($data, $this->rules($aliasId));
    }

    public function rules($aliasId = null)
    {
        return [
            'domain_id' => 'required',
            'source' => 'required|email',
            'destination' => 'required|email',
        ];
    }
}
<?php

namespace Viviniko\Mail\Repositories\User;

use Viviniko\Support\ValidatesData;

trait ValidatesUserData
{
    use ValidatesData;

    public function validateCreateData($data)
    {
        $this->validate($data, $this->rules());
    }

    public function validateUpdateData($userId, $data)
    {
        $this->validate($data, $this->rules($userId));
    }

    public function rules($userId = null)
    {
        $userId = is_null($userId) ? '' : ',' . $userId;
        $rules = [
            'domain_id' => 'required',
            'email' => 'required|email|unique:' . config('mail.virtual_users_table') . ',email' . $userId,
            'role' => 'required',
        ];
        if ($userId == '') {
            $rules['password'] = 'required';
        }
        return $rules;
    }
}
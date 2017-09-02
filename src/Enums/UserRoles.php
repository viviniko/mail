<?php

namespace Viviniko\Mail\Enums;


class UserRoles
{
    const USER = 'user';
    const SERVICE = 'service';

    public static function values()
    {
        return [
            static::USER => 'User',
            static::SERVICE => 'Service',
        ];
    }
}
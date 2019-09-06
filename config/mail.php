<?php

return [

    'default_driver' => 'swift.mailer',

    /*
    |--------------------------------------------------------------------------
    | mail virtual aliases.
    |--------------------------------------------------------------------------
    |
    | This is the mail alias model.
    |
    */
    'alias' => 'Viviniko\Mail\Models\Alias',

    /*
    |--------------------------------------------------------------------------
    | mail virtual aliases.
    |--------------------------------------------------------------------------
    |
    | This is the mail domain model.
    |
    */
    'domain' => 'Viviniko\Mail\Models\Domain',

    /*
    |--------------------------------------------------------------------------
    | mail virtual aliases.
    |--------------------------------------------------------------------------
    |
    | This is the mail template model.
    |
    */
    'template' => 'Viviniko\Mail\Models\Template',

    /*
    |--------------------------------------------------------------------------
    | mail virtual users.
    |--------------------------------------------------------------------------
    |
    | This is the mail user model.
    |
    */
    'user' => 'Viviniko\Mail\Models\User',

    /*
    |--------------------------------------------------------------------------
    | Domains Table
    |--------------------------------------------------------------------------
    |
    | This is the domains table.
    |
    */
    'virtual_aliases_table' => 'mail_virtual_aliases',

    /*
    |--------------------------------------------------------------------------
    | Domains Table
    |--------------------------------------------------------------------------
    |
    | This is the domains table.
    |
    */
    'virtual_domains_table' => 'mail_virtual_domains',

    /*
    |--------------------------------------------------------------------------
    | Templates Table
    |--------------------------------------------------------------------------
    |
    | This is the templates table.
    |
    */
    'virtual_users_table' => 'mail_virtual_users',

    /*
    |--------------------------------------------------------------------------
    | Templates Table
    |--------------------------------------------------------------------------
    |
    | This is the templates table.
    |
    */
    'templates_table' => 'mail_templates',
];
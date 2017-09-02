<?php

namespace Viviniko\Mail\Console\Commands;

use Viviniko\Support\Console\CreateMigrationCommand;

class MailTableCommand extends CreateMigrationCommand
{
    /**
     * @var string
     */
    protected $name = 'mail:table';

    /**
     * @var string
     */
    protected $description = 'Create a migration for the mail service table';

    /**
     * @var string
     */
    protected $stub = __DIR__.'/stubs/mail.stub';

    /**
     * @var string
     */
    protected $migration = 'create_mail_table';
}

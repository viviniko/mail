<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailTable extends Migration
{
    /**
     * @var string
     */
    protected $virtualDomainsTable;

    /**
     * @var string
     */
    protected $virtualUsersTable;

    /**
     * @var string
     */
    protected $virtualAliasesTable;

    /**
     * @var string
     */
    protected $templatesTable;

    /**
     * CreateCustomerTable constructor.
     */
    public function __construct()
    {
        $this->virtualDomainsTable = Config::get('mail.virtual_domains_table');
        $this->virtualUsersTable = Config::get('mail.virtual_users_table');
        $this->virtualAliasesTable = Config::get('mail.virtual_aliases_table');
        $this->templatesTable = Config::get('mail.templates_table');
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create table for storing customer
        Schema::create($this->virtualDomainsTable, function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
        });

        // Create table for storing customer password resets
        Schema::create($this->virtualUsersTable, function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('domain_id');
            $table->string('email', 100);
            $table->string('password', 150);
            $table->string('role', 32);

            $table->unique('email');

            // $table->foreign('domain_id')->references('id')->on($this->virtualDomainsTable)
            //    ->onDelete('cascade');
        });

        Schema::create($this->virtualAliasesTable, function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('domain_id');
            $table->string('source', 100);
            $table->string('destination', 100);

            // $table->foreign('domain_id')->references('id')->on($this->virtualDomainsTable)
            //     ->onDelete('cascade');
        });

        Schema::create($this->templatesTable, function (Blueprint $table) {
            $table->increments('id');
            $table->string('key', 50)->nullable();
            $table->string('name', 50);
            $table->string('group', 50)->nullable();
            $table->string('from', 100)->nullable();
            $table->string('subject');
            $table->mediumText('content');
            $table->timestamps();

            $table->unique(['key']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->virtualAliasesTable);
        Schema::dropIfExists($this->virtualDomainsTable);
        Schema::dropIfExists($this->virtualUsersTable);
        Schema::dropIfExists($this->templatesTable);
    }
}
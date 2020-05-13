<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestLogsTable extends Migration
{
    /**
     * The database schema.
     *
     * @var \Illuminate\Database\Schema\Builder
     */
    protected $schema;

    /**
     * Create a new migration instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->schema = Schema::connection('mysql'); // TODO 暂时写死
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('request_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('request_id');
            $table->string('request_url', 255);
            $table->string('method', 10);
            $table->json('request_headers');
            $table->json('request_data');
            $table->string('response_status', 3);
            $table->json('response_headers');
            $table->json('response_data');
            $table->dateTime('created_at')->nullable();

            $table->unique('request_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('request_logs');
    }
}

<?php

namespace Wufly\Log;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestLogEntriesTable extends Migration
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
            $table->longText('request_headers');
            $table->longText('request_data');
            $table->string('response_status', 3);
            $table->longText('response_headers');
            $table->longText('response_data');
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

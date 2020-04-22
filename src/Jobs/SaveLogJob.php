<?php

namespace Wufly\Log\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use DB;
use Illuminate\Support\Facades\Config;

class SaveLogJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    /**
     * 任务可以执行的最大秒数 (超时时间)。
     * @var int
     */
    public $timeout = 60;

    /**
     * 任务可以尝试的最大次数。
     *
     * @var int
     */
    public $tries = 5;

    protected $table;
    protected $data;

    /**
     * SaveLogJob constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->table = Config::get('requestLog.table');
        // 插入到数据库 TODO 暂时只支持mysql
        DB::table($this->table)->insert($this->data);
    }
}

<?php

namespace App\Console\Commands;

use DB;
use Illuminate\Console\Command;

class ExecuteSql extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ExecuteSql:run {method}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '执行SQL';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $method_name = $this->argument('method');
        if (method_exists($this, $method_name)) {
            $this->$method_name();
        } else {
            $this->info('找不到要执行的方法');
        }
    }

    public function test()
    {
        echo "test run sql";
    }
}

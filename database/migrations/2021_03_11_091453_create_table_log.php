<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->data();
    }

    /***
     * 插入路由数据
     */
    private function data()
    {
        $id = DB::table('admin_role_permissions')->insertGetId([
            'parent_id' => 0,
            'icon' => 'fa-terminal',
            'rule' => 'log',
            'name' => '行为日志管理',
        ]);

        DB::table('admin_role_permissions')->insert([
            [
                'parent_id' => $id,
                'rule' => 'syslog/index',
                'name' => '系统日志',
            ],
            [
                'parent_id' => $id,
                'rule' => 'syslog/download',
                'name' => '下载系统日志',
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

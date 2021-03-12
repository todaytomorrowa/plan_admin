<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableConfig extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config', function (Blueprint $table) {
            $table->smallIncrements('id')->comment('配置 ID');
            $table->SmallInteger('parent_id')->default(0)->comment('配置父 ID');
            $table->string('title', 64)->comment('配置标题');
            $table->string('key', 64)->unique()->comment('系统配置名称');
            $table->string('value', 256)->comment('系统配置值');
            $table->smallInteger('input_type')->default(0)->comment('配置输入类型 0输入框，1下拉框，2复选框');
            $table->smallInteger('value_type')->default(0)->comment('配置值 验证类型 0字符串，1数字，2大于零正数');
            $table->string('input_option', 256)->default('')->comment('输入选项，当input_type 为下拉框或者复选框使用');
            $table->string('description', 256)->default('')->comment('配置描述');
            $table->boolean('is_disabled')->index()->default(0)->comment('配置项是否禁用');
            $table->timestamps();
        });

        $this->data();
    }

    private function data()
    {
        //网站管理菜单
        $id = DB::table('admin_role_permissions')->insertGetId([
            'parent_id' => 0,
            'icon' => 'fa-cog',
            'rule' => 'site',
            'name' => '网站管理',
        ]);
        DB::table('admin_role_permissions')->insert([
            [
                'parent_id' => $id,
                'rule' => 'config/index',
                'name' => '配置管理',
            ],
            [
                'parent_id' => $id,
                'rule' => 'config/create',
                'name' => '添加配置',
            ],
            [
                'parent_id' => $id,
                'rule' => 'config/edit',
                'name' => '编辑配置',
            ],
            [
                'parent_id' => $id,
                'rule' => 'config/set',
                'name' => '设置配置',
            ],
            [
                'parent_id' => $id,
                'rule' => 'config/refresh',
                'name' => '刷新配置',
            ],
            [
                'parent_id' => $id,
                'rule' => 'config/disable',
                'name' => '启用或禁用配置',
            ],
            [
                'parent_id' => $id,
                'rule' => 'config/delete',
                'name' => '删除配置',
            ],
            [
                'parent_id' => $id,
                'rule' => 'monitor/index',
                'name' => '系统异常监控',
            ],
            [
                'parent_id' => $id,
                'rule' => 'upload/index',
                'name' => '图片上传',
            ],
            [
                'parent_id' => $id,
                'rule' => 'upload/delpic',
                'name' => '删除图片',
            ],
            [
                'parent_id' => $id,
                'rule' => 'config/refreshapp',
                'name' => '发送刷新页面广播',
            ],
        ]);

        //网站基础设置
        $app_parent_id = DB::table('config')->insertGetId([
            'parent_id' => 0,
            'title' => '网站设置',
            'key' => 'app',
            'value' => '1',
            'description' => '网站设置',
        ]);
        DB::table('config')->insert([
            [
                'parent_id' => $app_parent_id,
                'title' => '关闭访问',
                'key' => 'app_closed',
                'value' => '0',
                'description' => '0或1',
            ],
            [
                'parent_id' => $app_parent_id,
                'title' => '网站标题',
                'key' => 'web_title',
                'value' => '阿波罗娱乐系统',
                'description' => '',
            ],
            [
                'parent_id' => $app_parent_id,
                'title' => '网站标识',
                'key' => 'app_ident',
                'value' => 'test',
                'description' => '网站标识',
            ],
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

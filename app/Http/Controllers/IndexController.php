<?php

namespace App\Http\Controllers;

use Service\Models\Admin\AdminUser;
use DB;

class IndexController extends controller{
    public function getIndex() {
        $data = [];
        $data['admin'] = AdminUser::select([
            'admin_users.id',
            'admin_users.usernick',
            'admin_users.username',
            'admin_users.is_locked',
            'admin_users.created_at',
            'admin_users.last_time',
            'admin_users.last_ip',
            'admin_users.google_key',
            DB::raw('(CASE admin_users.id
                        WHEN 1 THEN \'超级管理员\'
                        ELSE string_agg(admin_roles.name, \'、\')
                        END) as role_name')
        ])
            ->leftJoin('admin_user_has_role', 'admin_users.id', 'admin_user_has_role.user_id')
            ->leftJoin('admin_roles', 'admin_user_has_role.role_id', 'admin_roles.id')
            ->where('admin_users.id', auth()->id())->groupBy('admin_users.id')
            ->first();
        return view('iframe', $data);
    }

    public function getDashboard()
    {
        return view('index');
    }

}

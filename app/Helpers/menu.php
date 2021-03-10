<?php

use Service\API\Admin\Menu;

function get_menu($user, $cached = false)
{
    if (app()->environment() == 'production') {
        $cached = true;
    }

    if ($cached) {
        return Cache::store('apc')->remember("admin_menu_{$user->id}", 1, function () use ($user) {
            return Menu::getMenu($user, ['aup.id', 'aup.parent_id', 'aup.icon', 'aup.rule', 'aup.name']);
        });
    }

    return Menu::getMenu($user, ['aup.id', 'aup.parent_id', 'aup.icon', 'aup.rule', 'aup.name']);
}

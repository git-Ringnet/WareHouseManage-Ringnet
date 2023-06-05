<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Request;

class Helper
{
    public static function isActiveRouteGroup($routeGroup)
    {
        $currentRoute = Route::currentRouteName();
        $routes = is_array($routeGroup) ? $routeGroup : explode(',', $routeGroup);

        if (in_array($currentRoute, $routes)) {
            return 'active';
        }

        return '';
    }
}

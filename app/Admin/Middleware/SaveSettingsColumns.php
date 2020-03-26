<?php

namespace App\Admin\Middleware;

use App\Admin\Models\AdminUsersColumns;
use Encore\Admin\Facades\Admin;
use Illuminate\Http\Request;
use Closure;
use Illuminate\Support\Facades\Route;

/**
 * Class SaveSettingsColumns
 * @package App\Admin\Middleware
 */
class SaveSettingsColumns
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $currentRoute = Route::currentRouteName();

        if (strpos($currentRoute, '.index') === false) {
            $response = $next($request);
            return $response;
        }

        $columns = $this->checkSettingsColumnsUser($request->all(), $currentRoute);

        if ($columns !== null) {
            $request->merge(['_columns_' => $columns]);
        }

        $response = $next($request);

        return $response;
    }

    /**
     * @param array $request
     * @param string $currentRoute
     * @return null
     */
    public function checkSettingsColumnsUser(array $request, string $currentRoute)
    {
        $this->saveSettingsColumnsUser($request, $currentRoute);

        if (!empty($request['_columns_'])) {
            return null;
        }

        $settingsColumns = AdminUsersColumns::whereUserId(Admin::user()->id)
            ->whereRoute($currentRoute)
            ->first();

        if ($settingsColumns === null || empty($settingsColumns->columns)) {
            return null;
        }

        return $settingsColumns->columns;
    }

    /**
     * @param array $request
     * @param string $currentRoute
     * @return bool
     */
    public function saveSettingsColumnsUser(array $request, string $currentRoute)
    {
        if (empty($request['_columns_'])) {
            return false;
        }

        $settingsColumns = AdminUsersColumns::firstOrNew([
            'user_id' => Admin::user()->id,
            'route' => $currentRoute
        ]);

        $settingsColumns->user_id = Admin::user()->id;
        $settingsColumns->route = $currentRoute;
        $settingsColumns->columns = $request['_columns_'];
        $settingsColumns->save();

        return true;
    }
}
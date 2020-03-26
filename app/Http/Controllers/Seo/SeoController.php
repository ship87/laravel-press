<?php

namespace App\Http\Controllers\Seo;

use App\Common\Setting\Models\Setting as SettingModel;
use App\Common\Setting\Services\Setting as SettingService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

/**
 * Class SeoController
 * @package App\Http\Controllers\Seo
 */
class SeoController extends Controller
{
    /**
     * @param SettingService $settingService
     * @return \Illuminate\Http\Response
     */
    public function showRobots(SettingService $settingService)
    {

        /** @var SettingModel $robots */
        $robots = $settingService->getByName('robots');
        $text = $robots instanceof SettingModel ? $robots->value : '';
        $contents = View::make('client.seo.robots', ['text' => $text])->with('url', route('main'));

        $response = Response::make($contents);
        $response->header('Content-Type', 'text/plain');

        return $response;
    }
}

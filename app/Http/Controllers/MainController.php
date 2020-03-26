<?php

namespace App\Http\Controllers;

use Torann\LaravelMetaTags\Facades\MetaTag;

/**
 * Class MainController
 * @package App\Http\Controllers
 */
class MainController extends Controller
{
    public function index()
    {
        MetaTag::set('title', 'LaravelPress');
        MetaTag::set('description', 'LaravelPress is a blog as Wordpress');

        return view('client.index');
    }
}

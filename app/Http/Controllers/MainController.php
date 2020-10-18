<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Services\TelegramService;
use Illuminate\Http\Request;
use Telegram\Bot\Api;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('main.index', ['products' => Product::orderBy('id', 'desc')->take(8)->get()]);
    }
}

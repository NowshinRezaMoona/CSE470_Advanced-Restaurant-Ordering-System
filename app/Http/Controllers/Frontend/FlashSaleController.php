<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Frontend\HomeController;

class FlashSaleController extends Controller
{
    public function index()
    {
        $flashSaleDate = FlashSale::first();
        $flashSaleItems = FlashSaleItem::where('status', 1)->paginate(10);
        return view('frontend.pages.flash-sale', compact('flashSaleDate', 'flashSaleItems'));
    }

}

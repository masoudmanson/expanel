<?php

namespace App\Http\Controllers;

use App\Exchanger;
use App\User;
use App\Rate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\PlatformTrait;
use jDate;

class RateController extends Controller
{
    use PlatformTrait;

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('checkToken');
        $this->middleware('checkUser');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $type = $request->input('type');
        if (empty($type))
            $type = 'euro';

        $currency_exchange = Auth::user()->currencyExchange;
        $result = $this->listProduct();
        $products = json_decode($result->getBody()->getContents())->result;
        $rates = array();

        $product_id = 0;
        if ($type == 'lira') {
            $rates['lira']['list'] = $currency_exchange->rates()->currency('TRY')->orderBy('rates.created_at', 'DESC')->paginate(10);
            $rates['lira']['max'] = $currency_exchange->rates()->currency('TRY')->get()->max('rate');
            $rates['lira']['min'] = $currency_exchange->rates()->currency('TRY')->get()->min('rate');
            foreach ($products as $product){
                if($product->description == 'TRY'){
                    $product_id = $product->entityId;
                }
            }

            $rate_lira = $currency_exchange->rates()->currency('TRY')->last();

            if (isset($rate_lira->rate)) {
                $lira_last_set_time = jdate($rate_lira->updated_at)->ago();
                $top_widget['lira_last_rate'] = $rate_lira->rate;
            } else {
                $top_widget['lira_last_rate'] = 0;
                $lira_last_set_time = 0;
            }
            return view('pages.rate', compact('type', 'rates', 'top_widget', 'lira_last_set_time'));
        } elseif ($type == 'euro') {
            $rates['euro']['list'] = $currency_exchange->rates()->currency('EUR')->orderBy('rates.created_at', 'DESC')->paginate(10);
            $rates['euro']['max'] = $currency_exchange->rates()->currency('EUR')->get()->max('rate');
            $rates['euro']['min'] = $currency_exchange->rates()->currency('EUR')->get()->min('rate');
            foreach ($products as $product){
                if($product->description == 'EUR'){
                    $product_id = $product->entityId;
                }
            }

            $rate_euro = $currency_exchange->rates()->currency('EUR')->last();

            if (isset($rate_euro->rate)) {
                $euro_last_set_time = jdate($rate_euro->updated_at)->ago();
                $top_widget['euro_last_rate'] = $rate_euro->rate;
            } else {
                $top_widget['euro_last_rate'] = 0;
                $euro_last_set_time = 0;
            }
            return view('pages.rate', compact('type', 'rates', 'top_widget', 'euro_last_set_time','product_id'));
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['exchanger_user_id'] = Auth::user()->id;
        $request['ip'] = $request->ip();
        dd($request);
        $response = $this->loadProduct($request->product_id)->getBody()->getContents();
        if(isset($response->result)) {
            $product = json_decode($response)->result;
            $product->price = $request->rate;
            $response = $this->updateProduct($product)->getBody()->getContents();
            if(isset($response->result)) {
                Rate::create($request->all());
                return redirect()->back();
            }
        }
        //return with error
    }
}

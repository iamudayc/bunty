<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;
use GuzzleHttp\Client as GuzzleClient;
use App\Models\Market;

class ScrapController extends Controller
{
    public function nifty()
    {
        $time=date("H:i:s");
       // dd($time);
        if($time >2 && $time <11)
        {
            $goutteClient = new Client();
            $guzzleClient = new GuzzleClient(array(
                'timeout' => 60,
                'verify' => false
            ));
            $goutteClient->setClient($guzzleClient);
            $crawler = $goutteClient->request('GET', 'https://www.moneycontrol.com/indian-indices/nifty-50-9.html');
            $crawler->filter('.indimprice')->each(function ($node) {
                $nifty_text=explode(" ",$node->text());
                Market::where('id', '1')->update([
                    'curvalue'    => $nifty_text[0],
                    'changeval'    => $nifty_text[1],
                    'changeper'    => $nifty_text[2]
                ]);
            });
        }
        
        
    }

    public function sensex()
    {
        $time=date("H");
        if($time >2 && $time <11)
        {
            $goutteClient = new Client();
            $guzzleClient = new GuzzleClient(array(
                'timeout' => 60,
                'verify' => false
            ));
            $goutteClient->setClient($guzzleClient);
            $crawler = $goutteClient->request('GET', 'https://www.moneycontrol.com/indian-indices/bse-sensex-4.html');
            $crawler->filter('.indimprice')->each(function ($node) {
                $nifty_text=explode(" ",$node->text());
                Market::where('id', 2)->update([
                    'curvalue'    => $nifty_text[0],
                    'changeval'    => $nifty_text[1],
                    'changeper'    => $nifty_text[2]
                ]);
            });
        }
        
    }

    public function nitybank()
    {
        $time=date("H");
        if($time >2 && $time <11)
        {
            $goutteClient = new Client();
            $guzzleClient = new GuzzleClient(array(
                'timeout' => 60,
                'verify' => false
            ));
            $goutteClient->setClient($guzzleClient);
            $crawler = $goutteClient->request('GET', 'https://www.moneycontrol.com/indian-indices/nifty-bank-23.html');
            $crawler->filter('.indimprice')->each(function ($node) {
                $nifty_text=explode(" ",$node->text());
                Market::where('id', 3)->update([
                    'curvalue'    => $nifty_text[0],
                    'changeval'    => $nifty_text[1],
                    'changeper'    => $nifty_text[2]
                ]);
            });
        }
        
    }

    public function niftyit()
    {
        $time=date("H");
        if($time >2 && $time <11)
        {
            $goutteClient = new Client();
            $guzzleClient = new GuzzleClient(array(
                'timeout' => 60,
                'verify' => false
            ));
            $goutteClient->setClient($guzzleClient);
            $crawler = $goutteClient->request('GET', 'https://www.moneycontrol.com/indian-indices/nifty-it-19.html');
            $crawler->filter('.indimprice')->each(function ($node) {
                $nifty_text=explode(" ",$node->text());
                Market::where('id', 4)->update([
                    'curvalue'    => $nifty_text[0],
                    'changeval'    => $nifty_text[1],
                    'changeper'    => $nifty_text[2]
                ]);
            });
        }
        
    }

    public function nikkei()
    {
        $time=date("H");
        if($time >0 && $time <8)
        {
            $goutteClient = new Client();
            $guzzleClient = new GuzzleClient(array(
                'timeout' => 60,
                'verify' => false
            ));
            $goutteClient->setClient($guzzleClient);
            $crawler = $goutteClient->request('GET', 'https://www.moneycontrol.com/live-market/nikkei');
            $crawler->filter('.stock_value_1')->each(function ($node) {
                Market::where('id', 5)->update([
                    'curvalue'    => $node->text(),
                ]);
            });

             $crawler->filter('.stock_value_2')->each(function ($node) {
                Market::where('id', 5)->update([
                    'changeval'    => $node->text(),
                ]);
            });

              $crawler->filter('.value_in_bracket')->each(function ($node) {
                Market::where('id', 5)->update([
                    'changeper'    => $node->text()
                ]);
            });
        }
        
    }

    public function gold()
    {
        $time=date("H:i:s");
        //dd($time);
        if($time >6 && $time <15)
        {
            $goutteClient = new Client();
            $guzzleClient = new GuzzleClient(array(
                'timeout' => 60,
                'verify' => false
            ));
            $goutteClient->setClient($guzzleClient);
            $crawler = $goutteClient->request('GET', 'https://www.moneycontrol.com/commodity/gold-price.html');
            //dd($crawler);
            $crawler->filter('#commodity_innertab0')->each(function ($node) {
                $nifty_text=explode(" ",$node->text());
                //dd($nifty_text);
                Market::where('id', '6')->update([
                    'curvalue'    => $nifty_text[3],
                    'changeval'    => $nifty_text[4],
                    'changeper'    => $nifty_text[5]
                ]);
            });
        }
        
    }

    public function silver()
    {
        $time=date("H:i:s");
        //dd($time);
        if($time >15 && $time <15)
        {
            $goutteClient = new Client();
            $guzzleClient = new GuzzleClient(array(
                'timeout' => 60,
                'verify' => false
            ));
            $goutteClient->setClient($guzzleClient);
            $crawler = $goutteClient->request('GET', 'https://www.moneycontrol.com/commodity/silver-price.html');
            //dd($crawler);
            $crawler->filter('#commodity_innertab0')->each(function ($node) {
                $nifty_text=explode(" ",$node->text());
                //dd($nifty_text);
                Market::where('id', '7')->update([
                    'curvalue'    => $nifty_text[3],
                    'changeval'    => $nifty_text[4],
                    'changeper'    => $nifty_text[5]
                ]);
            });
        }
        
    }

    public function crudeoil()
    {
        $time=date("H:i:s");
        //dd($time);
        if($time >6 && $time <15)
        {
            $goutteClient = new Client();
            $guzzleClient = new GuzzleClient(array(
                'timeout' => 60,
                'verify' => false
            ));
            $goutteClient->setClient($guzzleClient);
            $crawler = $goutteClient->request('GET', 'https://www.moneycontrol.com/commodity/crudeoil-price.html');
            //dd($crawler);
            $crawler->filter('#commodity_innertab0')->each(function ($node) {
                $nifty_text=explode(" ",$node->text());
                //dd($nifty_text);
                Market::where('id', '8')->update([
                    'curvalue'    => $nifty_text[3],
                    'changeval'    => $nifty_text[4],
                    'changeper'    => $nifty_text[5]
                ]);
            });
        }
        
    }

    public function usd()
    {
        $time=date("H:i:s");
        //dd($time);
        if($time >6 && $time <15)
        {
            //dd("A");
            $goutteClient = new Client();
            $guzzleClient = new GuzzleClient(array(
                'timeout' => 60,
                'verify' => false
            ));
            $goutteClient->setClient($guzzleClient);
            $crawler = $goutteClient->request('GET', 'https://in.investing.com/currencies/usd-inr');
            //dd($crawler);
            $crawler->filter('.last-price-and-wildcard')->each(function ($node) {
                $nifty_text=explode(" ",$node->text());
                //dd($nifty_text);
                Market::where('id', '9')->update([
                    'curvalue'    => $nifty_text[0],
                    'changeval'    => $nifty_text[1],
                    'changeper'    => $nifty_text[2]
                ]);
            });
        }
        
    }


}


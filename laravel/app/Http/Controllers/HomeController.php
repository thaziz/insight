<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;

use Validator;

use DB;

use App\Pengguna;

use Carbon\Carbon;

use Auth;

class HomeController extends Controller
{
    protected function getCurrencyRates() {
        $pair_arr = array('EURUSD', 'GBPUSD', 'USDJPY', 'XAUUSD', 'XAGUSD', 'USDJOD');
        $currencies_arr = array();

        foreach ($pair_arr as $pair) {
            try {
                
                $price_csv = file_get_contents("http://finance.yahoo.com/d/quotes.csv?e=.csv&f=sl1d1t1&s=$pair=X");
                $price_data = explode(',', $price_csv);
                $currencies_arr[$pair]['price'] = $price_data[1];
                $currencies_arr[$pair]['status'] = '';
            } catch (Exception $ex) {
                $currencies_arr['error'] = $ex->getMessage();
            }
        }
        return $currencies_arr;
    }

    public function pricesPage() {
    $prices = $this->getCurrencyRates();
    return View::make('pricesPage', array('prices' => $prices));        
}

public function pricesValues() {

            $response = new Symfony\Component\HttpFoundation\StreamedResponse(function() {
            $old_prices = array();

            while (true) {
                $new_prices = $this->getCurrencyRates();
                $changed_data = $this->getChangedPrices($old_prices, $new_prices);

                if (count($changed_data)) {
                    echo 'data: ' . json_encode($changed_data) . "\n\n";
                    ob_flush();
                    flush();
                }
                sleep(3);
                $old_prices = $new_prices;
            }
        });

        $response->headers->set('Content-Type', 'text/event-stream');
        return $response;
    }
    

    /**
     * comparing old and new prices and return only changed currency rates
     * @param array $old_prices
     * @param array $new_prices
     * @return array
     */
    protected function getChangedPrices($old_prices, $new_prices) {
        $ret = array();
        foreach ($new_prices as $curr => $curr_info) {
            if (!isset($old_prices[$curr])) {
                $ret[$curr]['status'] = '';
                $ret[$curr]['price'] = $curr_info['price'];                
            } elseif ($old_prices[$curr]['price'] != $curr_info['price']) {
                $ret[$curr]['status'] = $old_prices[$curr]['price']>$curr_info['price']?'down':'up';
                $ret[$curr]['price'] = $curr_info['price']; 
            }
        }

        return $ret;
    }

}

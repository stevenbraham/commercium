<?php

/**
 * Created by IntelliJ IDEA.
 * User: stevenbraham
 * Date: 14-04-17
 * Time: 19:46
 */

namespace commercium\components;
/**
 * QUAD class for interacting with markitondemand
 * ONLY WORKS FOR US COMPANIES
 */
class StockAPI {

    /**
     * Retrieves the current stock price
     * @param $symbol
     * @return double
     */
    public function getStockPrice($symbol) {
        set_time_limit(50);
        $data = json_decode(file_get_contents("http://dev.markitondemand.com/MODApis/Api/v2/Quote/json?symbol=" . $symbol));
        return $data->LastPrice;
    }

    /**
     * @param $symbol
     * @return \stdClass
     */
    public function getCompanyInfo($symbol) {
        set_time_limit(50);
        return json_decode(file_get_contents("http://dev.markitondemand.com/MODApis/Api/v2/Lookup/json?input=" . $symbol))[0];
    }
}
<?php
/**
 * Created by IntelliJ IDEA.
 * User: stevenbraham
 * Date: 12-04-17
 * Time: 20:48
 */

namespace commercium\repositories;


use commercium\controllers\CompaniesController;
use commercium\models\Company;
use framework\components\base\Core;
use framework\components\Repository;

class Companies extends Repository {
    public static function getModel() {
        return Company::class;
    }

    /**
     * Like the overview function of the Transactions repository, this function
     * also returns a specialized sql query
     * @see Transactions::getQuickOverview()
     * @see CompaniesController::actionIndex()
     * @return array
     */
    public static function getOverView() {
        $query = 'select c.company_id,c.company_name, e.exchange_name, sum(t.mutation_amount) as total_stocks' .
            ' FROM ' . static::getTable() . ' c' .
            ' join exchanges e on e.exchange_id = c.exchange_id' .
            ' join transactions t on t.company_id = c.company_id' .
            ' group by c.' . static::getPrimaryKeyAttribute() . ' ' .
            ' having total_stocks > 0 ' .
            ' order by c.company_name ';
        $statement = Core::getInstance()->database->prepare(trim($query));
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function getTable() {
        return "companies";
    }

    public static function getPrimaryKeyAttribute() {
        return "company_id";
    }

    /**
     * @param string $stockSymbol
     * @return Company
     */
    public static function findByStockSymbol($stockSymbol) {
        return static::findByAttribute("stock_symbol", $stockSymbol);
    }

    /**
     * @param $name
     * @param $stockSymbol
     * @param $exchangeId
     * @return Company
     */
    public static function insert($name, $stockSymbol, $exchangeId) {
        $query = "INSERT INTO `" . static::getTable() . "` (`company_name`,`stock_symbol`,`exchange_id`) VALUES (:name, :symbol, :exchange);";
        $statement = Core::getInstance()->database->prepare($query);
        $statement->execute([
            'name' => $name,
            'symbol' => $stockSymbol,
            'exchange' => $exchangeId
        ]);
        return static::findOrFail(Core::getInstance()->database->lastInsertId());
    }

}
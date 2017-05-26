<?php
/**
 * Created by IntelliJ IDEA.
 * User: stevenbraham
 * Date: 12-04-17
 * Time: 17:32
 */

namespace commercium\repositories;


use commercium\controllers\TransactionsController;
use commercium\models\Transaction;
use framework\components\base\Core;
use framework\components\Repository;

class Transactions extends Repository {
    public static function getModel() {
        return Transaction::class;
    }

    /**
     * Calculates the profits per day for a given date range
     * @param $startDate
     * @param $endDate
     * @return array
     */
    public static function getProfitsPerDay($startDate, $endDate) {
        $statement = Core::getInstance()->database->prepare("select -sum((mutation_price*mutation_amount)) as profit, date(timestamp) as day from " . static::getTable() . " where timestamp >= :start and timestamp <= :end group by day");
        $statement->execute(['start' => $startDate, 'end' => $endDate]);
        foreach ($statement->fetchAll(\PDO::FETCH_ASSOC) as $row) {
            $data[$row['day']] = (double)$row['profit'];
        }
        //plot missing values, strtotime converts both dates to unix time, 86400 is the number of seconds in 1 day
        for ($i = strtotime($startDate); $i < strtotime($endDate); $i += 86400) {
            $date = date("Y-m-d", $i);
            if (!isset($data[$date])) {
                $data[$date] = 0;
            }
        }
        ksort($data);
        return $data;
    }

    public static function getTable() {
        return "transactions";
    }

    /**
     * returns the total balance of the organisation
     * @return double
     */
    public static function getTotalProfit() {
        $statement = Core::getInstance()->database->prepare("select -sum((mutation_price*mutation_amount)) as profit from " . static::getTable());
        $statement->execute();
        return (double)$statement->fetchColumn(0);
    }

    /**
     * Specialized function for the transactions controller
     * @see TransactionsController::actionIndex()
     */
    public static function getQuickOverview() {
        $query = 'SELECT t.transaction_id, t.user_id, t.company_id, t.mutation_amount,t.mutation_price, (t.mutation_amount * t.mutation_price) as total_value, c.company_name, concat(u.firstname, " ",u.lastname) as user_name, t.timestamp' .
            ' FROM transactions t' .
            ' JOIN companies c ON t.company_id = c.' . Companies::getPrimaryKeyAttribute() .
            ' JOIN users u ON t.user_id = u.' . Users::getPrimaryKeyAttribute() .
            ' ORDER BY t.timestamp desc';
        $statement = Core::getInstance()->database->prepare(trim($query));
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @param $userId
     * @param $companyId
     * @param $pricePerStock
     * @param $totalStocks
     * @return Transaction
     */
    public static function insert($userId, $companyId, $pricePerStock, $totalStocks) {
        $query = "INSERT INTO `" . static::getTable() . "` (`user_id`,`company_id`,`mutation_price`,`mutation_amount`) VALUES (:user, :company, :price, :amount);";
        $statement = Core::getInstance()->database->prepare($query);
        $statement->execute([
            'user' => $userId,
            'company' => $companyId,
            'price' => $pricePerStock,
            'amount' => $totalStocks
        ]);
        return static::findOrFail(Core::getInstance()->database->lastInsertId());
    }

    /**
     * Counts all transactions in the database
     * @return int
     */
    public static function getTotalTransactionCount() {
        $query = "select count(" . static::getPrimaryKeyAttribute() . ") as count from `" . static::getTable() . "`;";
        $statement = Core::getInstance()->database->prepare($query);
        $statement->execute();
        return intval($statement->fetchColumn());
    }

    public static function getPrimaryKeyAttribute() {
        return "transaction_id";
    }

    /**
     * Gets the sum of all transactions in the database
     * @return float
     */
    public static function getTotalTransactionValue() {
        $query = "select sum(abs(mutation_amount) * mutation_price)  from `" . static::getTable() . "`;";
        $statement = Core::getInstance()->database->prepare($query);
        $statement->execute();
        return doubleval($statement->fetchColumn());
    }

    /**
     * Custom dataview for about page
     * @return array
     */
    public static function getAboutPageData() {
        $query = "SELECT c.company_name," .
            " sum(abs(mutation_amount) * mutation_price) as total_trade_value," .
            " sum(case when t.mutation_amount > 0 then abs(t.mutation_amount) else NULL end) as stocks_bought," .
            " sum(case when t.mutation_amount < 0 then abs(t.mutation_amount) else NULL end) as stocks_sold " .
            " from " . static::getTable() . " t" .
            " join companies c on c.company_id = t.company_id" .
            " group by t.company_id" .
            " order by c.company_name;";
        $statement = Core::getInstance()->database->prepare(trim($query));
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }
}
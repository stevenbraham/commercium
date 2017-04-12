<?php
/**
 * Created by IntelliJ IDEA.
 * User: stevenbraham
 * Date: 12-04-17
 * Time: 17:32
 */

namespace commercium\repositories;


use commercium\models\Transaction;
use framework\components\base\Core;
use framework\components\Repository;

class Transactions extends Repository {
    public static function getPrimaryKeyAttribute() {
        return "transaction_id";
    }

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
}
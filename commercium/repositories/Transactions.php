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

    public static function getTable() {
        return "transactions";
    }

    /**
     * Calculates the profits per day for a given date range
     * @param $startDate
     * @param $endDate
     * @return array
     */
    public static function getProfitsPerDay($startDate, $endDate) {
        $statement = Core::getInstance()->database->prepare("select -sum((mutation_price*mutation_amount)) as profit, date(timestamp) as day from transactions group by day");
        $statement->execute();
        foreach ($statement->fetchAll(\PDO::FETCH_ASSOC) as $row) {
            $data[$row['day']] = (double)$row['profit'];
        }
        return $data;
    }
}
<?php
/**
 * Created by IntelliJ IDEA.
 * User: stevenbraham
 * Date: 12-04-17
 * Time: 17:32
 */

namespace commercium\models;


use commercium\repositories\Users;
use framework\components\Model;

class Transaction extends Model {
    public static $primaryKeyAttribute = "transaction_id";

    public $transaction_id, $user_id, $company_id, $mutation_price, $mutation_amount, $timestamp;

    /**
     * Gets the total value of the transaction
     * Bases on the number of stocks traded and the price per stock
     * @return double
     */
    public function getTransactionValue() {
        return $this->mutation_amount * $this->mutation_price;
    }

    /**
     * Retrieves the user who ordered this transaction
     * @return User
     */
    public function getUser() {
        return Users::findById($this->user_id);
    }

    /**
     * Retrieves the company who's stocks were traded
     * @return User
     */
    public function getCompany() {

    }
}
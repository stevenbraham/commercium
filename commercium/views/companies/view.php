<?php
/**
 * Created by IntelliJ IDEA.
 * User: stevenbraham
 * Date: 14-04-17
 * Time: 18:31
 * @var \commercium\models\Company $company
 * @var \commercium\repositories\Transactions[] $transactions
 */
use framework\components\base\Html;

?>

<div class="row">
    <div class="col-md-4">
        <h2>General info</h2>
        <p>
            <label for="">Name:</label>
            <?= $company->company_name ?>
        </p>
        <p>
            <label for="">Exchange:</label>
            <?= $company->getExchange()->exchange_name ?>
        </p>
        <p>
            <label for="">Stock symbol:</label>
            <?= $company->stock_symbol ?>
        </p>
        <?= Html::a("transactions/new?symbol=" . $company->stock_symbol, "Trade stocks", 'btn btn-block btn-warning') ?>
        <a target="_blank" href="https://finance.yahoo.com/quote/<?= $company->stock_symbol ?>" class="btn btn-block btn-info">Get stock price</a>
    </div>
    <div class="col-md-8">
        <h2>Recent stock trades</h2>
        <table class="table table-striped">
            <thead>
            <tr>
                <th width="50px"></th>
                <th>User</th>
                <th>Transaction type</th>
                <th>Stocks traded</th>
                <th>Price per stock</th>
                <th>Total value</th>
                <th>Timestamp</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($transactions as $transaction) {
                ?>
                <tr>
                    <td class="text-center">
                        <?= Html::a('transactions/view?id=' . $transaction->getPrimaryKey(), '<i class="fa fa-eye"></i>', 'btn btn-info btn-xs') ?>
                    </td>
                    <td>
                        <?= $transaction->getUser()->getFullName() ?>
                    </td>
                    <?= $transaction->getTransactionValue() > 0 ? Html::element("td", 'Buy', ['class' => 'text-white label-danger']) : Html::element("td", 'Sale', ['class' => 'text-white label-success']) ?>
                    <td>
                        <?= abs($transaction->mutation_amount) ?>
                    </td>
                    <td>
                        $<?= number_format($transaction->mutation_price, 2) ?>
                    </td>
                    <td>
                        <?= $transaction->getTransactionValue() > 0 ? Html::element("span", "$" . number_format($transaction->getTransactionValue(), 2), ['class' => 'text-danger']) : Html::element("span", "$" . number_format(-$transaction->getTransactionValue(), 2), ['class' => 'text-success']) ?>
                    </td>
                    <td>
                        <?= $transaction->timestamp ?>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

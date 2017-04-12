<?php
/**
 * Created by IntelliJ IDEA.
 * User: stevenbraham
 * Date: 12-04-17
 * Time: 19:38
 * @var \commercium\models\Transaction[] $transactions
 */
use framework\components\base\Html;

?>
<div class="row">
    <div class="col-md-12">
        <table class="table table-striped">
            <thead>
            <tr>
                <th width="50px"></th>
                <th>User</th>
                <th>Company</th>
                <th>Transaction type</th>
                <th>Stocks traded</th>
                <th>Price per stock</th>
                <th>Total value</th>
                <th>Timestamp</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($transactions as $transaction) {
                ?>
                <tr>
                    <td class="text-center">
                        <?= Html::a('transactions/view?id=' . $transaction->getPrimaryKey(), '<i class="fa fa-eye"></i>', 'btn btn-info btn-xs') ?>
                    </td>
                    <td>
                        <?php
                        $user = $transaction->getUser();
                        if (!empty($user)) {
                            echo Html::a("users/edit?id=" . $user->getPrimaryKey(), $user->firstname . " " . $user->lastname);
                        }
                        ?>
                    </td>
                    <td>
                        <?= $transaction->company_id ?>
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

<?php
/**
 * Created by IntelliJ IDEA.
 * User: stevenbraham
 * Date: 12-04-17
 * Time: 19:38
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
            foreach ($transactions as $row) {
                ?>
                <tr>
                    <td class="text-center">
                        <?= Html::a('transactions/view?id=' . $row['transaction_id'], '<i class="fa fa-eye"></i>', 'btn btn-info btn-xs') ?>
                    </td>
                    <td>
                        <?= $row['user_name'] ?>
                    </td>
                    <td>
                        <?= Html::a("companies/view?id=" . $row['company_id'], $row['company_name']) ?>
                    </td>
                    <?= $row['total_value'] > 0 ? Html::element("td", 'Buy', ['class' => 'text-white label-danger']) : Html::element("td", 'Sale', ['class' => 'text-white label-success']) ?>
                    <td>
                        <?= abs($row['mutation_amount']) ?>
                    </td>
                    <td>
                        $<?= number_format($row['mutation_price'], 2) ?>
                    </td>
                    <td>
                        <?= $row['total_value'] > 0 ? Html::element("span", "$" . number_format($row['total_value'], 2), ['class' => 'text-danger']) : Html::element("span", "$" . number_format(-$row['total_value'], 2), ['class' => 'text-success']) ?>
                    </td>
                    <td>
                        <?= $row['timestamp'] ?>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

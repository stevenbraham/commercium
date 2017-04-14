<?php
use framework\components\base\Html;

?>
<div class="row">
    <div class="col-md-12">
        <p>Companies <u>can't</u> be manually added to our database. The only way to do is is to register a new <?= Html::a("transactions/new", "stock buy transaction") ?>. However only select users can do this.</p>
        <table class="table table-striped">
            <thead>
            <tr>
                <th width="50px"></th>
                <th>Name</th>
                <th>Exchange</th>
                <th>Stocks in portfolio</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($companies as $row) {
                ?>
                <tr>
                    <td><?= Html::a('companies/view?id=' . $row['company_id'], '<i class="fa fa-eye"></i>', 'btn btn-info btn-xs') ?></td>
                    <td><?= $row['company_name'] ?></td>
                    <td><?= $row['exchange_name'] ?></td>
                    <td><?= $row['total_stocks'] ?></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
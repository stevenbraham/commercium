<?php
/**
 * @var \commercium\models\Transaction $transaction
 */
use framework\components\base\Html;

$user = $transaction->getUser();
$company = $transaction->getCompany();
?>

<div class="row">
    <div class="col-md-12">
        <a class="btn btn-info pull-right" href="./">Go back</a>
        <br/> <br/>
        <div class="form-group">
            <label for="">
                Ordered by:
            </label>
            <input type="text" readonly value="<?= !empty($user) ? $user->getFullName() : "Unknown" ?>" class="form-control"/>
        </div>
        <div class="form-group">
            <label for="">
                Company involved
            </label>
            <div class="input-group">
                <input type="text" readonly value="<?= $company->company_name ?>" class="form-control"/>
                <span class="input-group-btn">
                    <?= Html::a("companies/view?id=" . $company->getPrimaryKey(), '<i class="fa fa-eye"></i> View', 'btn btn-info') ?> ?>
                </span>
            </div>
        </div>
        <div class="form-group">
            <label for="">
                Stocks traded
            </label>
            <input type="text" readonly value="<?= $transaction->mutation_amount ?>" class="form-control"/>
        </div>
        <div class="form-group">
            <label for="">
                Price per stock
            </label>
            <div class="input-group">
                <span class="input-group-addon">$</span>
                <input type="text" readonly value="<?= number_format($transaction->mutation_price, 2) ?>" class="form-control"/>
            </div>
        </div>
        <div class="form-group">
            <label for="">
                Total value
            </label>
            <div class="input-group">
                <span class="input-group-addon">$</span>
                <input type="text" readonly value="<?= number_format($transaction->getTransactionValue(), 2) ?>" class="form-control"/>
            </div>
        </div>
        <div class="form-group">
            <label for="">
                Timestamp
            </label>
            <div class="input-group">
                <input type="text" readonly value="<?= $transaction->timestamp ?>" class="form-control"/>
                <span class="input-group-addon"><?= \Carbon\Carbon::parse($transaction->timestamp)->diffForHumans() ?></span>
            </div>
        </div>
    </div>
</div>

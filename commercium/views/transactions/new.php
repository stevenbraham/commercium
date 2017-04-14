<?php
use framework\components\base\Html;

?>
<div class="row">
    <?= Html::openForm('transactions/store') ?>
    <div class="col-md-12">
        <div class="form-group">
            <label for="stockSymbol">Stock symbol:</label>
            <?= Html::inputField("stockSymbol", $stockSymbol, 'form-control') ?>
        </div>
        <div class="form-group">
            <label for="mutationAmount">Amount of stocks:</label>
            <input type="number" value="10" name="mutationAmount" id="mutationAmount" min="-100" max="100" class="form-control" required/>
            <b>A negative number means you are going to sell stocks, a positive number means that you are going to buy stocks</b>
        </div>
        <div class="form-group">
            <input type="checkbox" required id="confirm"/> <label for="confirm">Confirm transaction</label>
        </div>
        <input type="submit" class="btn btn-success" value="Start transaction"/>
    </div>
    </form>
</div>
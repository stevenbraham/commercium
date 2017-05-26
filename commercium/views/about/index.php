<div class="row">
    <div class="col-md-4">
        <h2>What is Commercium</h2>
        <p>
            Commercium is a platform designed for high performance stock market trading. Our smart input software let's your stock traders work 10 times faster and create more revenue for you.
        </p>
        <p>Currently Commercium has handled over <?= $totalTransactions ?> transactions with a total value of <b>$<?= number_format($totalValue, 2) ?></b>!</p>
        <a href="mailto:demo@hanze.nl?subject=Commercium%20demo&body=I%20want%20a%20Commercium%20demo" class="btn btn-success btn-block">Request demo</a>
    </div>
    <div class="col-md-8">
        <h2>Examples</h2>
        <p>
            We have performed trades with the following companies:
        </p>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>
                    Company
                </th>
                <th>Stocks bought</th>
                <th>Stocks sold</th>
                <th>Total trade value</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($tradeData as $row) {
                //update total stats
                $totalData['total_trade_value'] += $row['total_trade_value'];
                $totalData['stocks_bought'] += $row['stocks_bought'];
                $totalData['stocks_sold'] += $row['stocks_sold'];
                ?>
                <tr>
                    <td>
                        <?= $row['company_name'] ?>
                    </td>
                    <td>
                        <?= $row['stocks_bought'] ?>
                    </td>
                    <td>
                        <?= $row['stocks_sold'] ?>
                    </td>
                    <td>
                        $<?= number_format($row['total_trade_value'], 2) ?>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
            <tfoot>
            <tr>
                <td><b>Sum</b></td>
                <td><?= $totalData['stocks_bought'] ?></td>
                <td><?= $totalData['stocks_sold'] ?></td>
                <td>$<?= number_format($totalData['total_trade_value'], 2) ?></td>
            </tr>
            <tr>
                <td><b>Average per company</b></td>
                <td><?= intval($totalData['stocks_bought'] / count($tradeData)) ?></td>
                <td><?= intval($totalData['stocks_sold'] / count($tradeData)) ?></td>
                <td>$<?= number_format($totalData['total_trade_value'] / count($tradeData), 2) ?></td>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
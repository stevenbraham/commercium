<?php
/**
 * @var \commercium\models\User $user
 */
?>
<h2>Hello <?= $user->firstname ?></h2>
<h3>The current lifetime profit is <?= number_format($profit, 2) ?> dollar</h3>
<div id="curve_chart" style="width: 100%; height: 500px"></div>


<?php
use framework\components\base\Html;

/**
 * @var \commercium\models\User[] $users
 * @var \commercium\repositories\Groups[] $groups
 */
?>

<div class="row">
    <div class="col-md-12">
        <table class="table table-striped">
            <thead>
            <tr>
                <th width="50px"></th>
                <th>First name</th>
                <th>Last name</th>
                <th>E-mail</th>
                <?php
                //dynamic header for group types
                foreach ($groups as $group) {
                    echo "<th>{$group->name}</th>";
                }
                ?>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($users as $user) {
                ?>
                <tr>
                    <td class="text-center">
                        <?= Html::a('users/view?id=' . $user->getPrimaryKey(), '<i class="fa fa-pencil"></i>', 'btn btn-info btn-xs') ?>
                    </td>
                    <td><?= $user->firstname ?></td>
                    <td><?= $user->lastname ?></td>
                    <td><?= $user->email ?></td>
                    <?php
                    foreach ($groups as $group) {
                        echo '<td><i class="fa fa-' . ($user->isMemberOfGroup($group->slug) ? "check" : "times") . '"></i></td>';
                    }
                    ?>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <?= Html::a("users/new", '<i class="fa fa-plus"></i> New user', 'btn btn-success') ?>
    </div>
</div>

<?php
use framework\components\base\Html;

echo Html::inputField('id', $user->getPrimaryKey(), '', 'hidden');
?>
<div class="form-group">
    <label for="firstname">First name:</label>
    <?= Html::inputField('firstname', $user->firstname, 'form-control') ?>
</div>
<div class="form-group">
    <label for="lastname">Last name:</label>
    <?= Html::inputField('lastname', $user->lastname, 'form-control') ?>
</div>
<div class="form-group">
    <label for="lastname">New password:</label>
    <?= Html::inputField('newPassword', '', 'form-control', 'password', false) ?>
</div>
<?php
if (\framework\components\base\SessionManagement::getUser()->isMemberOfGroup("admins")) {
    ?>
    <div class="form-group">
        <label for="email">Email:</label>
        <?= Html::inputField('email', $user->email, 'form-control', 'email') ?>
    </div>
    <div class="form-group">
        <label for="group">Groups:</label>
        <?php
        foreach ($groups as $group) {
            ?>
            <div class="checkbox">
                <label>
                    <?= Html::checkbox('groups[]', $group->getPrimaryKey(), ($user->isMemberOfGroup($group->slug))) . ' ' . $group->name ?>
                </label>
            </div>
            <?php
        }
        ?>
    </div>
    <?php
}
?>

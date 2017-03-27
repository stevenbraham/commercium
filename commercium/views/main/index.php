<?php
/**
 * @var \commercium\models\User $user
 */
echo "Hello " . $user->firstname;
?>
<form action="?controller=login&action=logout" method="post">
    <button type="submit">Logout</button>
</form>

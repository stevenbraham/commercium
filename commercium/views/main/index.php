<?php
/**
 * @var \commercium\models\User $user
 */
$user = $this->getCore()->session->getUser();
echo "Hello " . $user->firstname;
?>
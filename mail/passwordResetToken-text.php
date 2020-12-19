<?php

/* @var $this yii\web\View */
/* @var $user app\models\user\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>
Hello <?= $user->user_name ?>,

Follow the link below to reset your password:

<?= $resetLink ?>

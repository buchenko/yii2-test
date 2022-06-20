<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <?php if (Yii::$app->user->isGuest):?>

            <h1 class="display-4">You must be logged for to do anything.!</h1>

        <?php else:?>

            <h1 class="display-4">Welcome,  <?= Yii::$app->user->identity->username ?>!</h1>

        <?php endif;?>
    </div>

</div>

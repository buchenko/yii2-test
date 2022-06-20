<?php

use app\models\Shop;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $model Shop */

$this->title = Yii::t('app', 'Create Shop');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Shops'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

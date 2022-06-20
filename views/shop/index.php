<?php

use app\models\Shop;
use app\models\ShopSearch;
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\jui\DatePicker;
use yii\web\View;

/* @var $this View */
/* @var $searchModel ShopSearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = Yii::t('app', 'Shops');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Shop'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'first_name',
            'last_name',
            'phone',
            [
                'attribute' => 'photo',
                'format' => 'raw',
                'value' => function (Shop $model) {
                    return Html::img('/' . $model->photo, ['style' => 'height: 100px']);
                },
            ],
            [
                'attribute' => 'created_at',
                'value' => 'created_at',
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'created_at',
                    'dateFormat' => 'dd-MM-yyyy',
                ]),
                'format' => 'date',
            ],
            [
                'attribute' => 'updated_at',
                'value' => 'updated_at',
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'updated_at',
                    'dateFormat' => 'dd-MM-yyyy',
                ]),
                'format' => 'date',
            ],
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Shop $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
            ],
        ],
    ]); ?>

</div>

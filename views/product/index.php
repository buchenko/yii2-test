<?php

use app\models\Category;
use app\models\Product;
use app\models\ProductSearch;
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\jui\DatePicker;
use yii\web\View;

/* @var $this View */
/* @var $searchModel ProductSearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = Yii::t('app', 'Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Product'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'price',
//            'category_id',
            [
                'label' => 'Category',
                'attribute' => 'category_id',
                'filter' => Category::find()->select(['name', 'id'])->indexBy('id')->column(),
                'value' => 'category.name',
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
                'urlCreator' => function ($action, Product $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>

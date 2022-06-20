<?php

use app\models\Shop;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this View */
/* @var $model Shop */
/* @var $form ActiveForm */
?>

<div class="shop-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone', ['enableClientValidation' => false])->widget(MaskedInput::class, [
        'mask' => ['99-999-9999', '999-999-9999'],
        'options' => [
            'maxlength' => 14,
            'class' => 'form-control',
            'placeholder' => Yii::t('app', '099-999-9999'),
        ],
        'clientOptions' => [
            'removeMaskOnSubmit' => true,
        ],
    ]) ?>

    <?php if (!empty($model->photo)): ?>
        <img src="/<?php echo $model->photo; ?>" alt="photo">
    <?php endif; ?>

    <?= $form->field($model, 'image')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

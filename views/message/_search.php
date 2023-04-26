<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Integrator;
use app\models\Message;

/** @var yii\web\View $this */
/** @var app\models\search\MessageSearch $model */
/** @var yii\widgets\ActiveForm $form */

$integratorList = ArrayHelper::map(Integrator::getActiveIntegrators(), 'id', 'name');
?>

<div class="message-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'message') ?>

    <?= $form->field($model, 'integrator_id')->dropDownList($integratorList, [
        'prompt' => 'Please choose an integrator'
    ]) ?>

    <?= $form->field($model, 'status')->dropDownList(Message::$statusLabels, [
        'prompt' => 'Please choose a status'
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

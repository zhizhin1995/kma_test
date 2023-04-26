<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Integrator;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\Message $model */
/** @var yii\widgets\ActiveForm $form */

$integratorList = ArrayHelper::map(Integrator::getActiveIntegrators(), 'id', 'name');
?>

<div class="message-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'message')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'integrator_id')->dropDownList($integratorList, ['prompt' => 'Please choose an integrator']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

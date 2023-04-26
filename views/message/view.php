<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Message;

/** @var yii\web\View $this */
/** @var app\models\Message $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Messages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="message-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'message:ntext',
            [
                'attribute' => 'integrator_id',
                'label' => 'Integrator',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->integrator->name;
                }
            ],
            [
                'attribute' => 'status',
                'label' => 'Status',
                'format' => 'raw',
                'value' => function ($model) {
                    return Message::$statusLabels[$model->status];
                }
            ],
            'created_at',
            'error_at',
            'sent_at'
        ],
    ]) ?>

</div>

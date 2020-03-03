<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MyUser */

$this->title = 'Update My User: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'My Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="my-user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

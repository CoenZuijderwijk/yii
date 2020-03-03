<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MyUser */

$this->title = 'Create My User';
$this->params['breadcrumbs'][] = ['label' => 'My Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="my-user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

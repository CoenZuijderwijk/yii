<?php
use yii\grid\GridView;
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'], 'name',
        ['class' => 'yii\grid\ActionColumn'],
        ['class' => 'yii\grid\CheckboxColumn'],
    ],
]);
?>
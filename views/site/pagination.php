<?php
use yii\widgets\LinkPager;
?>
<?php foreach ($models as $model): ?>
    <?= $model->id; ?>
    <?= $model->name; ?>
    <?= $model->email; ?>
    <br/>
<?php endforeach; ?>
<?php
// display pagination
echo LinkPager::widget([
    'pagination' => $pagination,
]);
?><?php

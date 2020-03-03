<?php
// display links leading to sort actions
echo $sort->link('id') . ' | ' . $sort->link('name') . ' | ' . $sort->link('email');
?><br/>
<?php foreach ($models as $model): ?>
    <?= $model->id; ?>
    <?= $model->name; ?>
    <?= $model->email; ?>
    <br/>
<?php endforeach; ?>
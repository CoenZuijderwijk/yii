<?php if($this->beginCache('cachedview')) {?>
    <table class="table">
        <thead>
        <th>Id</th>
        <th>Naam</th>
        <th>email</th>
        </thead>
        <tbody>
            <?php foreach ($models as $model) : ?>
            <tr>
                <td><?= $model->id; ?></td>
                <td><?= $model->name; ?></td>
                <td><?= $model->email; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php $this->endCache(); }?>
<?=  "Count:", \app\models\MyUser::find()->count(); ?>


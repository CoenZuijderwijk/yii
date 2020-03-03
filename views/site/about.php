<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use kartik\datetime\DateTimePicker;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
$this->registerMetaTag(['name' => 'keywords', 'content' => 'yii, developing, views,
      meta, tags']);
$this->registerMetaTag(['name' => 'description', 'content' => 'This is the description
      of this page!'], 'description');
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        This is the About page. You may modify the following file to customize its content:
    </p>
   <p>
       <b>Email: </b> <?= $email ?> <br>
       <b>Phone:</b> <?= $phone ?>
   </p>
    <?php
    echo DateTimePicker::widget([
            'name' => 'dp_1',
            'type' => DateTimePicker::TYPE_INPUT,
            'value' => '2-march-2020 12:06',
            'pluginOptions' => [
                            'autoclose'=>true,
                        'format' => 'dd-M-yyyy hh:ii'
                    ]
        ]);
    ?>
    <code><?= __FILE__ ?></code>
</div>
<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
$this->registerMetaTag(['name' => 'keywords', 'content' => 'yii, developing,
      views, meta, tags']);
$this->registerMetaTag(['name' => 'description', 'content' => 'This is the
      description of this page!'], 'description');
?>

<div class = "site-about">
    <h2>Christmas theme</h2>
    <img src = "http://pngimg.com/upload/fir_tree_PNG2514.png" alt = ""/>
    <p style = "color: red;">
        This is the About page. You may modify the following file to customize its content:
    </p>
</div>
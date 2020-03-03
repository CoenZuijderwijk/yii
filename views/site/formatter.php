<?php
$formatter = \Yii::$app->formatter;
echo $formatter->asDate(date('Y-m-d'), 'short'),"<br>";
echo $formatter->asDate(date('Y-m-d'), 'medium'),"<br>";
echo $formatter->asDate(date('Y-m-d'), 'long'),"<br>";
echo $formatter->asDate(date('Y-m-d'), 'full'),"<br>";
?>
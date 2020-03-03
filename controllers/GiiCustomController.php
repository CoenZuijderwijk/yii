<?php

namespace app\controllers;

use app\models\MyUser;

class GiiCustomController extends \yii\web\Controller
{
    public function actionHello()
    {
        return $this->render('hello');
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionWorld()
    {
        return $this->render('world');
    }

    public function actionView() {
        $model = new MyUser();
        return $this->render('/customview', [
            'model' => $model,
        ]);
    }

}

<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

Class ExampleController extends Controller {
    public $defaultAction = "hello-world";
    public function actions()
    {
        return [
            'greeting' => 'app\components\GreetingAction',
        ];
    }

    public function actionIndex() {
        $message = "index action of ExampleController";
        return $this->render("example" ,[
            "message" => $message
        ]);
    }

    public function actionHelloWorld() {
        return "Hello World";
    }

    public function actionOpenGoogle() {
        // redirect the user browser to http://google.com
        return $this->redirect('http://google.com');
    }

    public function actionTestParams($first, $second) {
        return "$first $second";
    }

}
?>

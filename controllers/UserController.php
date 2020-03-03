<?php
namespace app\controllers;
use yii\rest\ActiveController;
class UserController extends ActiveController {
    public $modelClass = 'app\models\MyUser';
    public function actions() {
        $actions = parent::actions();
        //disable the delete and create actions
        unset($actions['delete'], $actions['create']);
        return $actions;
    }
}
?>
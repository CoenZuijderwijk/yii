<?php
    namespace app\components;
    use yii\base\Behavior;
    use yii\db\ActiveRecord;
    class UppercaseBehaviour extends Behavior {
        public function events() {
            return [
                ActiveRecord::EVENT_BEFORE_VALIDATE => 'beforeValidate',
            ];
        }

        public function beforeValidate($event) {
            $this->owner->name = strtoupper($this->owner->name);
        }
    }
?>

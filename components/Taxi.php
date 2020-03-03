<?php
    namespace app\components;
    use yii\base\BaseObject;
    class Taxi extends BaseObject {
        private $_phone;
        public function getPhone() {
            return $this->_phone;
        }

        public function setPhone($value)
        {
            $this->_phone = trim($value);
        }
    }
<?php
    namespace app\components;
    use app\components\MyInterface;
    class Seccond implements MyInterface {
        public function test() {
            echo "Seccond class <br>";
        }
    }
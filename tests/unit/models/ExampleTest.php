<?php
    namespace tests\unit\models;

    use app\models\MyUser;
    use app\tests\fixtures\ExampleFixtures;
    use Codeception\Test\Unit;

    class ExampleTest extends Unit {
        public function _fixtures() {
            return [
                'profiles' => [
                    'class' => ExampleFixtures::className(),
                    'dataFile' => codecept_data_dir() . 'MyUser.php'
                ]
            ];
        }

        public function testCreateMyUser() {
            $m = new MyUser();
            $m->name = "myuser";
            $m->email = "myuser@email.com";
            $this->assertTrue($m->save());
        }


        public function testUpdateMyUser() {
            $m = new MyUser();
            $m->name = "myuser2";
            $m->email = "myuser2@mail.com";
            $this->assertTrue($m->save());
            $this->assertEquals("myuser2", $m->name);
        }

        public function testDeleteMyUser() {
            $m = MyUser::findOne(['name' => 'myuser2']);
            $this->assertNotNull($m);
            MyUser::deleteAll(['name' => $m->name]);
            $m = MyUser::findOne(['name' => 'myuser2']);
            $this->assertNull($m);
        }
    }

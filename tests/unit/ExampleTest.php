<?php

use app\models\MyUser;

class ExampleTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

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
        $this->assertEquals("myuser2", $m->name);
        $this->assertTrue($m->save());
    }

    public function testDeleteMyUser() {
        $m = MyUser::findOne(['name' => 'myuser2']);
        $this->assertNotNull($m);
        MyUser::deleteAll(['name' => $m->name]);
        $m = MyUser::findOne(['name' => 'myuser2']);
        $this->assertNull($m);
    }
}
<?php
use PHPUnit\Framework\TestCase;

require __DIR__ . "/../app/controllers/UserController.php";

class AuthTest extends TestCase
{
     public function getController()
     {
          return new UserInitName\User;
     }

     public function testShouldReturnUserIdIfUserExist()
     {
          $userController = $this->getController();
          $fixture = array(
               '0' => '1',
               'id' => '1',
               '1' => 'rirei0',
               'username' => 'rirei0',
               '2' => '123123',
               'password' => '123123',
               '3' => 'Testfname',
               'fname' => 'Testfname',
               '4' => 'Testlname',
               'lname' => 'Testlname',
               '5' => 'sample@email.com',
               'email' => 'sample@email.com',
               '6' => 'test',
               'usertype' => 'ow',
               '7' => '9999',
               'acc_balance' => '9999',
          );
          $res = $userController->check_login('rirei0', '12345');
          $resKeys = array_keys($res);
          $fixtureKeys = array_keys($fixture);
          $this->assertEquals($resKeys, $fixtureKeys);

     }

     public function testShouldReturnFalseIfUserDoesntExist()
     {
          $userController = $this->getController();
          $res = $userController->check_login('test', 'test');
          $this->assertEquals(false, $res);
     }

     public function testShouldReturnFalseIfEmailAlreadyExist()
     {
          $userController = $this->getController();
          $res = $userController->addUser('testusername', 'testfname', 'testlname', 'test@email', 'testpassword');
          $this->assertEquals(false, $res);
     }
}
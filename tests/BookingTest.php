<?php
//./vendor/bin/phpunit --testdox 
use PHPUnit\Framework\TestCase;

require __DIR__ . "/../app/sma/Calc.php";
require __DIR__ . "/../app/Calcu.php";
require __DIR__ . "/../app/controllers/BookController.php";

class BookingTest extends TestCase
{
    public function getController()
    {
        return new BookingsInitName\Bookings;
    }

    public function testShouldReturnTheBookingDetails()
    {
        $bookingController = $this->getController();
        $res = $bookingController->addBooking(1, 'test-from', 'test-to', 'test-depdate', 'test-retdate', 'test-type');

        $this->assertEquals(true, $res);
    }

    public function testShouldReturnBookingsIfIdExist()
    {
        $bookingController = $this->getController();
        $fixture = array(
            array(
                'id' => '1',
                'customer_id' => '1',
                'b_from' => 'Danao',
                'b_to' => 'Consolacion',
                'dep_date' => '05/01/2023',
                'ret_date' => '05/17/2023',
                'typet' => 'ow',
                'pay_status' => 'paid',
                'amount_paid' => '100',
            ),
            array(
                'id' => '18',
                'customer_id' => '1',
                'b_from' => 'Li-loan',
                'b_to' => 'Mandaue',
                'dep_date' => '05/01/2023',
                'ret_date' => '05/17/2023',
                'typet' => 'ow',
                'pay_status' => 'paid',
                'amount_paid' => '100',
            ),
        );

        $res = $bookingController->getBooking(1);

        foreach ($fixture as $index => $booking) {
            $fixtureKeys = array_keys($booking);
            $resKeys = array_keys($res[$index]);

            $this->assertSame($fixtureKeys, $resKeys);
        }
    }

    public function testShouldReturnFalseIfIdDidntExist()
    {
        $bookingController = $this->getController();
        $res = $bookingController->getBooking(1000);
        $this->assertEquals(false, $res);
    }

    public function testShouldReturnTrueIfBalanceIsEnoughAndPaymentIsSuccessAndBalanceUpdated()
    {
        $bookingController = $this->getController();
        $res = $bookingController->payBooking(1, 100, 9999, 100, 41);
        $this->assertEquals(true, $res);
    }

    public function testShouldReturnFalseIfBalanceIsEnough()
    {
        $bookingController = $this->getController();
        $res = $bookingController->payBooking(1, 100, 0, 100, 41);
        $this->assertEquals(false, $res);
    }

    public function testShouldReturnUserDetailsToGetMoneyBalance()
    {
        $bookingController = $this->getController();
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

        $res = $bookingController->getMoneyAmount(1);
        $resKeys = array_keys($res);
        $fixtureKeys = array_keys($fixture);
        $this->assertEquals($resKeys, $fixtureKeys);
    }

}
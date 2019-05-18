<?php
declare(strict_types=1);

namespace App\Tests\Checkout;

use PHPUnit\Framework\TestCase;
use App\Helpers\Session as SessionHelper;
use App\Helpers\Checkout as CheckoutHelper;
use App\Models\Session;
use App\Controllers\CheckoutController;
use App\Models\ZohoHelpers\ZohoHandler;
use App\Validators\Checkout as CheckoutValidator;


require_once dirname(__DIR__, 1).'/wp-content/themes/gotravel-child/definitions.php';

/**
 * @coversDefaultClass \App\Validators\Checkout<\App\Validators\Validator>
 */
class CheckoutValidatorTest extends TestCase
{
  protected $assignKeys = [];
  public static function setUpBeforeClass () {
    
  } 
    
  /**
   * @testdox return false if required field are not defined
   * @group CheckoutValidator
   * @covers validate
   * @todo foreach required fields
   */
  public function testEmptyRequest() {
    $stubSession = $this->createMock(Session::class);
    //mocking the session
    $stubSession->method('getMyTrip')
         ->willReturn(SessionHelper::voidSession());
    $stubSession->method('id')
    ->willReturn('fakeId');
    
    // nothing
    $payload = CheckoutHelper::get();
    $c = new CheckoutValidator();    
    $result = $c->validate($payload, $stubSession);
    $m = $c->getMessages();    

    $this->assertEquals($result, false);
    $this->assertEquals($m['message'], 'Not valid or expired session');

    // nothing but token
    $payload = CheckoutHelper::_token('fakeToken')->get();
    $c = new CheckoutValidator();    
    $result = $c->validate($payload, $stubSession);
    $m = $c->getMessages();  
    $this->assertEquals($result, false);
    $this->assertEquals($m['message'], 'Not valid or expired session');
  }

  /**
   * @testdox should false when _token and sesionId don't match
   * @group CheckoutValidator
   * @covers validate
   */
  public function testNotValidToken() {
    $stubSession = $this->createMock(Session::class);
    //mocking the session
    $stubSession->method('getMyTrip')
         ->willReturn(SessionHelper::voidSession());
    $stubSession->method('id')
    ->willReturn('realToken');
    
    $payload = CheckoutHelper::contact('Juan','Maria')->date('1','2','2018')->get();
    $c = new CheckoutValidator();    
    $result = $c->validate($payload, $stubSession);
    $m = $c->getMessages();
    $this->assertEquals($result, false);
  }

  /**
   * @testdox should false when firstName or lastName are empty
   * @group CheckoutValidator
   * @covers validate
   */
  public function testNotEmptyContact() {
    $stubSession = $this->createMock(Session::class);
    //mocking the session
    $stubSession->method('getMyTrip')
         ->willReturn(SessionHelper::voidSession());
    $stubSession->method('id')
    ->willReturn('fakeToken');
    
    $payload = CheckoutHelper::_token('fakeToken')->contact('','Maria')->date('1','2','2018')->get();
    $c = new CheckoutValidator();    
    $result = $c->validate($payload, $stubSession);
    $m = $c->getMessages();    
    $this->assertEquals($result, false);

    $payload = CheckoutHelper::_token('fakeToken')->contact('Juan','')->date('1','2','2018')->get();
    $c = new CheckoutValidator();    
    $result = $c->validate($payload, $stubSession);
    $m = $c->getMessages();    
    $this->assertEquals($result, false);

    $payload = CheckoutHelper::_token('fakeToken')->contact('','')->date('1','2','2018')->get();
    $c = new CheckoutValidator();    
    $result = $c->validate($payload, $stubSession);
    $m = $c->getMessages();
    $this->assertEquals($result, false);
  }

  /**
   * @testdox should false when email is empty or not valid
   * @group CheckoutValidator
   * @covers  validate
   */
  public function testValidEmail() {
    $stubSession = $this->createMock(Session::class);
    //mocking the session
    $stubSession->method('getMyTrip')
         ->willReturn(SessionHelper::voidSession());
    $stubSession->method('id')
    ->willReturn('fakeToken');
    
    //empty email
    $payload = CheckoutHelper::_token('fakeToken')
      ->contact('Juan','Maria')
      ->date('1','2','2018')
      ->get();
    $c = new CheckoutValidator();    
    $result = $c->validate($payload, $stubSession);
    $m = $c->getMessages();    
    $this->assertEquals($result, false);

    //not valid email
    $payload = CheckoutHelper::_token('fakeToken')
      ->contact('Juan','Maria','a')
      ->date('1','2','2018')
      ->get();
    $c = new CheckoutValidator();    
    $result = $c->validate($payload, $stubSession);
    $m = $c->getMessages();
    $this->assertEquals($result, false);
  }

  /**
   * @testdox should false when date is empty or not valid
   * @group CheckoutValidator
   * @covers validate
   * @todo
   */
  public function testValidDate() {
    $stubSession = $this->createMock(Session::class);
    //mocking the session
    $stubSession->method('getMyTrip')
         ->willReturn(SessionHelper::voidSession());
    $stubSession->method('id')
    ->willReturn('fakeToken');

    $payload = CheckoutHelper::_token('fakeToken')
      ->contact('Juan','Maria', 'a@c.com')
      ->date('1','2','')
      ->get();
    $c = new CheckoutValidator();    
    $result = $c->validate($payload, $stubSession);
    $m = $c->getMessages();
    $this->assertEquals($result, false);

    //not
    $payload = CheckoutHelper::_token('fakeToken')
      ->contact('Juan','Maria','a@c.com')
      ->date('1','','2018')
      ->get();
    $c = new CheckoutValidator();    
    $result = $c->validate($payload, $stubSession);
    $m = $c->getMessages();
    $this->assertEquals($result, false);

    //not
    $payload = CheckoutHelper::_token('fakeToken')
    ->contact('Juan','Maria','a@c.com')
    ->date('','3','2018')
    ->get();
    $c = new CheckoutValidator();    
    $result = $c->validate($payload, $stubSession);
    $m = $c->getMessages();
    $this->assertEquals($result, false);
  }

  
/**
   * @testdox should fail if full day or car without addres
   * @group CheckoutValidator
   * @covers validate
   * @todo
   */
  public function testValidAddress() {
    $stubSession = $this->createMock(Session::class);
    //mocking the session
    $stubSession->method('getMyTrip')
         ->willReturn(SessionHelper::fullDaySession());
    $stubSession->method('id')
    ->willReturn('fakeToken');

    $payload = CheckoutHelper::_token('fakeToken')
      ->contact('Juan','Maria', 'a@c.com')
      ->date('1','2','2018')
      ->car('', '')
      ->get();
    $c = new CheckoutValidator();    
    $result = $c->validate($payload, $stubSession);
    $m = $c->getMessages();
    
    $this->assertEquals($result, false);
    $this->assertEquals($m['message'], 'pick up address is required');    
  }


/**
   * @testdox should pass the validation
   * @group CheckoutValidator
   * @covers validate
   * @todo
   */
  public function testPassValidation() {
    $stubSession = $this->createMock(Session::class);
    //mocking the session
    $stubSession->method('getMyTrip')
         ->willReturn(SessionHelper::fullDaySession());
    $stubSession->method('id')
    ->willReturn('fakeToken');

    $payload = CheckoutHelper::_token('fakeToken')
      ->contact('Juan','Maria', 'a@c.com')
      ->date('1','2','2018')
      ->car('', 'corrientes 348')
      ->get();
    $c = new CheckoutValidator();    
    $result = $c->validate($payload, $stubSession);
    
    $this->assertEquals($result, true);
  }

  
}
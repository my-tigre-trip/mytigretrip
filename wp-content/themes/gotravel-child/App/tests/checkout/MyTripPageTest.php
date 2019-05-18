<?php
declare(strict_types=1);

namespace App\Tests\Checkout;

use PHPUnit\Framework\TestCase;
use App\Helpers\Session as SessionHelper;
use App\Helpers\Calculator as CalculatorHelper;
use App\Models\Session;
use App\Models\Calculator;
use App\Models\Wordpress;
use App\Controllers\CheckoutController;
use Symfony\Component\DomCrawler\Crawler;

require dirname(__DIR__, 6).'/wp-load.php';

class MyTripPageTest extends TestCase
{
  
  
  public function testRedirectWhenSessionDoesntHasSelectedTrip() {
    
    $stubSession = $this->createMock(Session::class);
    //mocking the session
    $stubSession->method('getMyTrip')
         ->willReturn(SessionHelper::noValidSession());

    $stubWordpress = $this->getMockBuilder(Wordpress::class)
      ->setMethods(['redirectHome'])
      ->getMock();
    //mocking the session
    $stubWordpress->expects($this->once())
        ->method('redirectHome');    
    //dependencies WP & Session
    $checkout = new CheckoutController($stubWordpress, $stubSession, null);

    //capturing the rendered view - no view in this case
    $view = $checkout->myTrip();    

    $this->assertEquals($view, false);  
  }

  /**
   * rare case but taking care
   */
  public function testSessionVoid() {
    
    $stubSession = $this->createMock(Session::class);
    //mocking the session
    $stubSession->method('getMyTrip')
         ->willReturn(SessionHelper::voidSession());

    $stubWordpress = $this->getMockBuilder(Wordpress::class)
      ->setMethods(['redirectHome'])
      ->getMock();
    //mocking the session
    $stubWordpress->expects($this->once())
        ->method('redirectHome');    
    //dependencies WP & Session
    $checkout = new CheckoutController($stubWordpress, $stubSession, null);

    //capturing the rendered view - no view in this case
    $view = $checkout->myTrip();    

    $this->assertEquals($view, false);  
  }

  /**
   * speedboat trip view
   */
  public function testSpeedboatSessionViewWithNoCar() {
    
    $stubSession = $this->createMock(Session::class);
    //mocking the session
    $stubSession->method('getMyTrip')
      ->willReturn(SessionHelper::speedBoatSession());

    $stubWordpress = $this->getMockBuilder(Wordpress::class)
      ->setMethods(['redirectHome'])
      ->getMock();
    //mocking the session
    $stubWordpress->expects($this->never())
        ->method('redirectHome');   
        
    $stubCalculator  = $this->createMock(Calculator::class);
    $stubCalculator->method('calculatePrice')
      ->willReturn(CalculatorHelper::speedBoatPrice());

    //dependencies WP & Session
    $checkout = new CheckoutController($stubWordpress, $stubSession, $stubCalculator);

    //capturing the rendered view - no view in this case
    $view = $checkout->myTrip();
    ob_start();
    echo $view->render();
    $output = ob_get_clean();  
    //var_dump($view->render());
    $view = $output;
    
    $crawler = new Crawler($view);
    // check title
    $title = $crawler->filter('title');    
    //$this->assertContains('Checkout', $title->text());

    $summary = $crawler->filter('#mtt-sumary');    
    //var_dump($summary);
    //$this->assertCount(1, $summary);

   // $this->assertEquals($view, false);  
  }
}
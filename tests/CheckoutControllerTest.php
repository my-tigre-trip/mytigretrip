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
 * @coversDefaultClass \App\Controllers\CheckoutCheckout<\App\Controllers\Controller>
 */
class CheckoutValidatorTest extends TestCase {
    private $zohoHandlerStub;
    private $formatterStub;
    private $sessionStub;

    public function setUp() {
        $sessionStub = $this->createMock(Session::class);
        $formatterStub = $this->createMock(Session::class);
        $zohoHandlerStub = $this->createMock(Session::class);
    }
}
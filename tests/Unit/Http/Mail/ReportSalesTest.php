<?php

namespace Tests\Unit\Http\Mail;

use App\Mail\ReportSales;
use App\Models\OrderDetail;
use Mockery;
use Tests\TestCase;

class ReportSalesTest extends TestCase
{
    public $orderDetails;
    public $report;

    public function setUp(): void
    {
        parent::setUp();
        $this->orderDetails = Mockery::mock(OrderDetail::class)->makePartial();
        $this->report = new ReportSales(
            $this->orderDetails
        );
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        Mockery::close();
        unset($this->report);
    }

    public function testBuild()
    {
        $response = $this->report->build();
        $this->assertInstanceOf(ReportSales::class, $response);
    }
}

<?php

namespace Tests\Unit\Console\Commands;

use App\Console\Commands\ReportCommand;
use App\Contracts\Repositories\OrderDetailRepository;
use App\Contracts\Repositories\UserRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Mockery;
use Tests\TestCase;

class ReportCommandTest extends TestCase
{
    public $reportCommand;

    public function setUp(): void
    {
        parent::setUp();
        $this->reportCommand = new ReportCommand();
    }

    public function tearDown(): void
    {
        parent::tearDown();
        unset($this->reportCommand);
    }

    public function testSignature()
    {
        $signature = 'report:sales';
        $this->assertEquals($signature, $this->reportCommand->signature);
    }

    public function testDescription()
    {
        $description = 'Sales report at 8:00am on the last day of the month.';
        $this->assertEquals($description, $this->reportCommand->description);
    }

    public function testHandle()
    {
        Mail::fake();

        $orderDetail = Mockery::mock(OrderDetailRepository::class)->makePartial();
        $orderDetail->id = 1;

        $user = Mockery::mock(UserRepository::class)->makePartial();
        $user->email = 'test@gmail.com';

        $user->shouldReceive('findAdmin')->andReturn($user);
        $orderDetail->shouldReceiVe('getOrderApproveOfMonth')->andReturn();

        $response = $this->reportCommand->handle($orderDetail, $user);
        $this->assertEquals($response, Command::SUCCESS);
    }
}

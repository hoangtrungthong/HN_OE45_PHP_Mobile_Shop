<?php

namespace Tests\Unit\Console\Commands;

use App\Console\Kernel;
use Illuminate\Console\Scheduling\Schedule;
use Mockery;
use Tests\TestCase;

class KernelCommandTest extends TestCase
{
    public $kernelCommand;

    public function setUp(): void
    {
        parent::setUp();
        $this->kernelCommand =  $this->app->make(Kernel::class);
    }

    public function tearDown(): void
    {
        parent::tearDown();
        unset($this->kernelCommand);
    }

    public function testSchedule()
    {
        $schedule = Mockery::mock(Schedule::class)->makePartial();
        $schedule->shouldReceive('command->lastDayOfMonth')->andReturn(true);

        $response = $this->kernelCommand->schedule($schedule);
        $this->assertNull($response);
    }
}

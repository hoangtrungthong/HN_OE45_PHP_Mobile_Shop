<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReportSales extends Mailable
{
    use Queueable, SerializesModels;

    public $report;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($report)
    {
        $this->report = $report;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $month = Carbon::now()->month;
        $year = Carbon::now()->year;

        return $this->markdown(
            'emails.reports.sales',
            [
                'reports' => $this->report,
                'month' => $month,
                'year' => $year,
            ]
        )->subject(
            '[ ' . config('app.name') . ' ] ' . __('common.report_sales') . $month . '/' . $year
        );
    }
}

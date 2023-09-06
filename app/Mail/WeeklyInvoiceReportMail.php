<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WeeklyInvoiceReportMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $weekly_pdf_report;

    public function __construct($weekly_pdf_report)
    {
        $this->weekly_pdf_report = $weekly_pdf_report;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Weekly Invoice Report')
        ->attachData($this->weekly_pdf_report, 'Weekly Invoice Report.pdf', [
            'mime' => 'application/pdf',
        ])
        ->view('users.emails.weekly_invoice_report');
    }
}

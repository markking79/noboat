<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


class adminReportIssue extends Mailable
{
    use Queueable, SerializesModels;

    public $issue;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($issue)
    {
        //
        $this->issue = $issue;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.admin.reportissue');
    }
}

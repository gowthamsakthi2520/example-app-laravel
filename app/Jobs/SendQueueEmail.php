<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;
use App\Mail\ExcelSheetMailer;
class SendQueueEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $details['name']=$this->data['name'];
        $details['email']=$this->data['email'];
        $details['subject']='Test Excel Sheet Mail';

        $ExcelSheetMailer = new ExcelSheetMailer($details);
        Mail::to($this->data['email'])->cc('raghul@oceansoftwares.in')->send($ExcelSheetMailer);

    }
}

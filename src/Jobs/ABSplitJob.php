<?php
 
namespace Teamtnt\SalesManagement\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
 
class ABSplitJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
 
    public function __construct($leadId) {
        $this->lead = $leadId;
        $this->mailId = $mailId;
    }
 
    public function handle(): void
    {
        if(rand(1,2) == 1 ) {
            info("Spliting to A");
        } else {
            info("Spliting to B");
        }
    }
}
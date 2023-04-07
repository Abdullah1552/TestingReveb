<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\SaleOrderMail;
use App\Models\WhereHouse;

class SendSaleOrderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $SID;
    public $WHID;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($SID,$WHID)
    {
        $this->SID=$SID;
        $this->WHID=$WHID;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $emil=WhereHouse::where('id',$this->WHID)->value('WH_Email');
        Mail::to($emil)->send(new SaleOrderMail($this->SID));
    }
}

<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Traits\WooSyncTrait;

class WoocommerceUploadProduct implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels,WooSyncTrait;

    protected $company_id, $product_id;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($company_id,$product_id)
    {
        $this->company_id = $company_id;
        $this->product_id = $product_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->sync_product($this->product_id);
    }
}

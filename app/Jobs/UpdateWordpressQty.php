<?php

namespace App\Jobs;

use Codexshaper\WooCommerce\Facades\Product;
use Codexshaper\WooCommerce\Models\Variation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class UpdateWordpressQty implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

//    public $message;
    public $wp_id;
    public $variant_id;
    public $variant_data;
    public $wp_qty;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($wp_id, $variant_id, $variant_data,$wp_qty)
    {
        $this->wp_id = $wp_id;
        $this->variant_id = $variant_id;
        $this->variant_data = $variant_data;
        $this->wp_qty = $wp_qty;
        Log::info('queue called');

//        $this->message=[$wp_id, $variation_id, $variation_data,$wp_qty];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Product::update($this->wp_id, ['stock_quantity' => $this->wp_qty]);
        if (isset($this->variant_id) && $this->variant_id > 0) {
            Variation::update($this->wp_id, $this->variant_id, $this->variant_data);
        }

        /*Product::update($this->message[0], ['stock_quantity'=>$this->message[3]]);
        if($this->message[1]>0) {
            Variation::update($this->message[0], $this->message[1], $this->message[2]);

        }*/
    }
}

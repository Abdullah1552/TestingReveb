<?php

namespace App\Jobs;

use App\Models\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class WhatsAppMessageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($customer_id)
    {
        $this->data=[$customer_id];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $customer=Customer::find($this->data[0]);
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://graph.facebook.com/v13.0/107413172063800/messages',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
            "messaging_product": "whatsapp",
            "preview_url": false,
            "recipient_type": "individual",
            "to": "'.$customer->phone_number.'",
            "type": "text",
            "text": {
                "body": "Thanks You '.$customer->name.' thankfull and appreciates your support and trust on us.You can be confident that we are committed to your satisfaction."
            }
        }',
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json',
                        'Authorization: Bearer EAALWPYVZCez0BAAbr8JungTBUETLCU1d2O4okrenZCo33ly6lfVByYBRWewEMLfV8mS3cyRdsFEyvAoOOa5q2ZARbwofY9ZCudpQCrLIF9ZCDLNYRaZCF7HfZCxZBjzTTEtRFAc1LZCGZAOvu0BHROshTvxHZBF83edtam30a2h1ADNGYJlT9BOEHoO'
                    ),
                ));

        $response = curl_exec($curl);

        curl_close($curl);
//        echo $response;
    }
}

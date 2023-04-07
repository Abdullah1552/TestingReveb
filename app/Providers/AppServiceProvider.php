<?php

namespace App\Providers;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Config;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Schema::defaultStringLength('191');

        // //set timezone
        // $bs=DB::table('business_settings' )->select('time_zone')->first();
        // if(isset($bs->time_zone) && $bs->time_zone){
        //     config(['app.timezone' => (string)$bs->time_zone]);
        //     date_default_timezone_set($bs->time_zone);
        // }

        //set Email configuration
        // $mail = DB::table('mail_settings' )->first();
        // Config::set('mail.driver', 'smtp');
        // Config::set('mail.host', $mail->mail_host);
        // Config::set('mail.port', $mail->mail_port);
        // Config::set('mail.username', $mail->mail_address);
        // Config::set('mail.password', $mail->password);
        // Config::set('mail.encryption', $mail->encryption);
        // Config::set('mail.from',array('address' => $mail->mail_address, 'name' => $mail->mail_from_name));


        // //check woocomerce is on and then set the configurations
        // if (woo_state()) {
        //     $ws = DB::table('woocommerce_settings' )->select('woocommerce_url', 'woocommerce_sk', 'woocommerce_sc')->first();
        //     config(['woocommerce.store_url' => $ws->woocommerce_url]); //set
        //     config(['woocommerce.consumer_key' => $ws->woocommerce_sk]); //set
        //     config(['woocommerce.consumer_secret' => $ws->woocommerce_sc]); //set
        // }
    }
}

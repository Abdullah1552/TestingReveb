<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("

            CREATE TABLE  `companies` (
              `company_id` bigint NOT NULL,
              `user_id` bigint DEFAULT NULL,
              `company` varchar(250) NOT NULL,
              `business_type` int DEFAULT NULL,
              `deals_in` enum('product','service') NOT NULL DEFAULT 'product',
              `industry` int DEFAULT NULL,
              `industry_type` enum('manufacturing','trading','service','indentation') NOT NULL DEFAULT 'trading',
              `sub_industry` int DEFAULT NULL,
              `user_status` varchar(255) NOT NULL,
              `email` varchar(250) NOT NULL,
              `phone` varchar(250) NOT NULL,
              `mobile` varchar(100) NOT NULL,
              `fax` varchar(100) NOT NULL,
              `website` varchar(250) NOT NULL,
              `address` mediumtext NOT NULL,
              `country` varchar(100) NOT NULL,
              `city` varchar(150) NOT NULL,
              `state` varchar(150) NOT NULL,
              `logo` varchar(250) NOT NULL,
              `modules` mediumtext NOT NULL,
              `remarks` mediumtext NOT NULL,
              `setup` tinyint(1) NOT NULL,
              `status` enum('active','inactive','pending','suspend') NOT NULL DEFAULT 'active',
              `affiliate_id` bigint NOT NULL,
              `coupon_id` bigint NOT NULL,
              `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
              `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
              `is_default` int NOT NULL,
              `branding` tinyint NOT NULL DEFAULT '1',
              `admin_modules` mediumtext,
              `lock_invoice` int NOT NULL DEFAULT '0',
              `total_package_amount` decimal(20,3) NOT NULL,
              `discount_amount` decimal(20,3) NOT NULL,
              `invoiced_amount` decimal(20,3) NOT NULL,
              `user_price` decimal(20,3) NOT NULL,
              `warehouse_price` decimal(20,3) NOT NULL,
              `payroll_price` decimal(20,3) NOT NULL,
              `crm_price` decimal(20,3) NOT NULL,
              `production_price` decimal(20,3) NOT NULL,
              `bank_name` varchar(191) DEFAULT NULL,
              `account_title` varchar(191) DEFAULT NULL,
              `account_number` varchar(191) DEFAULT NULL,
              `bank_address` varchar(191) DEFAULT NULL,
              PRIMARY KEY (`company_id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;            

            ");
        DB::statement("INSERT INTO `companies` (`company_id`, `user_id`, `company`, `business_type`, `deals_in`, `industry`, `industry_type`, `sub_industry`, `user_status`, `email`, `phone`, `mobile`, `fax`, `website`, `address`, `country`, `city`, `state`, `logo`, `modules`, `remarks`, `setup`, `status`, `affiliate_id`, `coupon_id`, `updated_at`, `created_at`, `is_default`, `branding`, `admin_modules`, `lock_invoice`, `total_package_amount`, `discount_amount`, `invoiced_amount`, `user_price`, `warehouse_price`, `payroll_price`, `crm_price`, `production_price`, `bank_name`, `account_title`, `account_number`, `bank_address`) VALUES ('', '1', 'Carlanisa', NULL, 'product', NULL, 'trading', NULL, 'ssss', 'carlanisa.com', '22', '22', '22', '22', '22', 'pakistan', 'ss', 'ss', 'ss', 'ss', 'ss', '1', 'active', '0', '0', '0000-00-00 00:00:00.000000', CURRENT_TIMESTAMP, '0', '1', NULL, '0', '1', '1', '1', '1', '1', '1', '1', '1', NULL, NULL, NULL, NULL);");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}

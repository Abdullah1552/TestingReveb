# REVEBE-POS

username: admin@gmail.com   
pasword; 123456


TRUNCATE stock_details;
TRUNCATE sale_invoices;
TRUNCATE products;
TRUNCATE product_variants;
TRUNCATE sale_returns;
TRUNCATE categories;
TRUNCATE brands;
TRUNCATE unit_types;
TRUNCATE attributes;
TRUNCATE purchase_orders;
TRUNCATE purchase_invoices;
TRUNCATE purchase_returns;
TRUNCATE o_inventories;
TRUNCATE adjustments;
TRUNCATE transfers;

product brand & unit not go on WOOcomerce



cron commands to be run on the server

php -d register /home3/revebe57/public_html/carlanisa.revebe.com/artisan schedule:run >/dev/null 2>&1

php -d register /home3/revebe57/public_html/carlanisa.revebe.com/artisan queue:retry all >/dev/null 2>&1

php -d register /home3/revebe57/public_html/carlanisa.revebe.com/artisan queue:work --stop-when-empty --timeout=0 >/dev/null 2>&1

php -d register /home3/revebe57/public_html/business.revebe.com/artisan queue:work --timeout=0 >/dev/null 2>&1
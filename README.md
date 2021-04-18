# A very small LAMP stack

## To run the ndungu branch 

1. Start apache. *If* neccessary:
- `apt install apache2`
- `sudo apt install php libapache2-mod-php php-mysql`
- do some editing at sudo nano /etc/apache2/sites-available/your_domain.conf
- Let's go! `sudo systemctl reload apache2`
2. Make sure it is pointing at this code. `/var/www/sample_store`  
3.  Get in the browser and hope for a confirm message in browser: `localhost/orders.php`
4.  Go into mysql and confirm the db changed:  
`select * from orders_products;`
`select * from orders;`
4. For syncing during development I found Beyond Compare convenient to sync my projects folder to the /var/www

## File one: config

Not committed!

## File two: orders.php
 
This is higher level.  It has the SQL query.  It has the fake data as an array. It applies this to the db by running `DBTransaction` helper function.

## File three: DBTransaction

This uses the PDO object and its methods:  
* setAttribute
* beginTransaction
* prepare
* execute
* commit

The construct function for PDO is where the password and username and database get applied.

## The heidi branch 

Has:
* __index.html__ useful html/css to save
* __data.php__  use PDO object to get db contents. Has Try-Catch.


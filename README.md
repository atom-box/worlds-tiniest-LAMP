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

## Deploy
Some archived commands from Kubuntu history:
```
1100     sudo apt install apache2
1101     sudo ufw allow in "Apache"
1102     sudo apt install mysql-server
1103     sudo mysql_secure_installation
1104     sudo apt install php libapache2-mod-php php-mysql
1105     php -v
1106     history
1107     sudo mysql
1108     sudo mkdir /var/www/finlandiaEXAMPLE.COM
1109     sudo chown -R $USER:$USER /var/www/finlandiaEXAMPLE.COM
1110     sudo nano /etc/apache2/sites-available/finlandiaEXAMPLE.COM.conf
1111     sudo a2ensite finlandiaEXAMPLE.COM
1112     echo sudo a2dissite 000-default
1113     sudo apache2ctl configtest
1114     sudo mkdir /var/www/your_domain
1115     sudo chown -R $USER:$USER /var/www/your_domain
1116     sudo nano /etc/apache2/sites-available/your_domain.conf
1117     sudo a2ensite your_domain
1118     sudo a2dissite 000-default
1119     sudo apache2ctl configtest
1120     sudo systemctl reload apache2
1121     nano /var/www/your_domain/index.html

```

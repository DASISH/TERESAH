DASISHT23
=======================

### Warning
This readme is only written for Ubuntu/Debian machine. It has been tested on a VM using Ubuntu 12.10

### Install LAMP

First we need to install a wamp solution on your machine

    sudo apt-get install apache2
    sudo apt-get install php5 php5-common php5-mysql php5-gd php5-curl
    sudo apt-get install mysql-server

Last line will ask you to set a password at some point, **please remind it or use "root" as password**, so you wont need to change any configuration file on your local machine.

**If you need to access this machine from outside, install ssh**

	sudo apt-get install ssh

### Install GIT
To install git software, use 

	sudo apt-get install git
	
### Download actual code

In your terminal, do :

	cd ~/
	mkdir dev
	git clone https://github.com/PonteIneptique/DASISHT23.git
	
Then we need to configure your apache

	cd /etc/apache2/sites-enabled
	sudo cp ~/dev/DASISHT23/www/API.config ./api
	sudo rm 000-default
	sudo ln -s /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled/rewrite.load

**Then edit the API config file in apache2 (/etc/apache2/sites-enabled/API) so your username is used (Change {{USERNAME}} to your actual username on this machine). Use nano ./api or gedit ./api or any ssh ftp system **
	
Then restart your apache2 Server

	sudo /etc/init.d/apache2 restart
	
If your server doesn't start and you get an arror about 127.0.1.1 http://ze-soft.blogspot.co.uk/2011/10/solved-could-not-reliably-determine.html

### Install the database

In your terminal, follow these steps :

	cd ~/dev/DASISHT23/
	mysql --user=root --password=root < ./DataModel/sql/install.sql 
	mysql --user=root --password=root < ./DataModel/sql/scheme.sql 
	
### Using Crawling data

** Before using any data issued by /crawling/Bamboo/sql.py ** , please use this command as well
	mysql --user=root --password=root tools_registry < ./DataModel/sql/nobug.sql 

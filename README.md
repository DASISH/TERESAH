DASISHT23
=======================

### Warning
This readme is only written for Ubuntu/Debian machine. It has been tested on a VM using Ubuntu 12.10

### Install WAMP

First we need to install a wamp solution on your machine

    sudo apt-get install apache2
    sudo apt-get install php5
    sudo apt-get install mysql-server

Last line will ask you to set a password at some point, please remind it or use "root" as password, so you wont need to change any configuration file on your local machine.

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
	curl https://raw.github.com/PonteIneptique/DASISHT23/master/www/API.config > /etc/apache2/sites-enabled/API

**Then edit the API config file in apache2 (/etc/apache2/sites-enabled/API) so your username is used (Change {{USERNAME}} to your actual username on this machine)**
	
----------------------------------------    

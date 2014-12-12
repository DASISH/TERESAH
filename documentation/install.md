# Installation of TERESAH

## Requirements
* PHP 5.5+
* Composer
* MySQL / Postgres / SQL Server
* Apache (other webservers can be used)

# Clone repository
In the install  folder for TERESAH run
```git clone https://github.com/DASISH/TERESAH```

# Install composer
Install composer on your server https://getcomposer.org/download/

# Install depencencies via composer
TERESAH requires some third party libraries, all of these can be installed via composer.
To install run:
```composer install```

# Create a database for TERESAH
Create a empty database for TERESAH in MySQL / Postgres / SQL Server.

# Copy and edit the configuration file
Make a copy of the configuration template ``.env.environment.php.template``.
For a production server the name shoud be ``.env.production.php``
Fill in the values for your database connection, configuration if oauth is used etc.

# Initiate the database
To create the database structure run ``php artisan migrate``. The tables will be created.

To fill the database with content from ``app/database/seeds/data/data.csv`` run:
```php artisan db:seed```

# Configure Apache
The webserver should be configured to use ``TERESAH/public`` as the webb root folder.

Example of configuration:
```xml
<VirtualHost teresah.myhost.org:80>
    ServerAdmin webmaster@myhost.org
    DocumentRoot "/home/TERESAH/public/"
	
	<Directory "/home/TERESAH/public/">
	   Order allow,deny
	   Allow from all
	   AllowOverride All
	</Directory>
	
    ServerName teresah.myhost.org
    ErrorLog "logs/teresah.myhost.org-error.log"
    CustomLog "logs/teresah.myhost.org-access.log" common
</VirtualHost>
```

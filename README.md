ISC web
=======

Requirements
------------

- [Apache HTTP server 2.4](https://httpd.apache.org/)
- [MySQL 5.7](https://www.mysql.com/) or higher
- [PHP 7.0](https://secure.php.net/) or higher
- [Composer](https://getcomposer.org)
- [Node.js 8](https://nodejs.org) or higher

Installation
------------

### Linux

1. Install and configure Apache + MySQL + PHP (see [this guide](https://www.digitalocean.com/community/tutorials/how-to-install-linux-apache-mysql-php-lamp-stack-ubuntu-18-04))
1. Install:
	1. [Git](https://git-scm.com)
	1. [Composer](https://getcomposer.org)
	1. [Node.js 8](https://nodejs.org)
	1. [Yarn package manager](https://yarnpkg.com)
1. Generate SSH public/private key pair
	1. In terminal run
		
			ssh-keygen -t rsa -b 2048

	1. Add the created `id_rsa.pub` SSH key to your GitHub account
1. In terminal navigate to the directory in which you want the iscweb sources to be downloaded
1. Then run the following commands in terminal:

		git clone git@github.com:ISCCTU/iscweb.git
		cd iscweb
		composer install
		yarn install
		yarn run development
		cp .env.example .env
		php artisan key:generate

1. Open the `.env` file and change the database credintials

		DB_USERNAME=root
		DB_PASSWORD=

1. Set up the apache virtualhost

		<VirtualHost *:80>
			ServerName iscweb

			# Path to the public folder in iscweb local repo, e.g.
			DocumentRoot /var/www/iscweb/public
			<Directory /var/www/iscweb/public>
				AllowOverride All
				Require local
			</Directory>
		</VirtualHost>

1. If you don't have `mod_rewrite` enabled then run the following commands in terminal:

		sudo a2enmod rewrite
		sudo service apache2 restart

1. Import the ISC database
	1. Into the address bar enter `iscweb/adminer.php`
	1. Log in to the database (Username: `root`, password you set during MySQL installation)
	1. Click `Import` and import the file you will get from IT Coordinator

### Windows

1. Download and install:
	1. Visual C++ Redistributable for Visual Studio 2012 [64-bit](https://download.microsoft.com/download/1/6/B/16B06F60-3B20-4FF2-B699-5E9B7962F9AE/VSU_4/vcredist_x64.exe) / [32-bit](https://download.microsoft.com/download/1/6/B/16B06F60-3B20-4FF2-B699-5E9B7962F9AE/VSU_4/vcredist_x86.exe)
	1. Visual C++ Redistributable for Visual Studio 2013 [64-bit](http://download.microsoft.com/download/0/5/6/056dcda9-d667-4e27-8001-8a0c6971d6b1/vcredist_x64.exe) / [32-bit](http://download.microsoft.com/download/0/5/6/056dcda9-d667-4e27-8001-8a0c6971d6b1/vcredist_x86.exe)
	1. Visual C++ Redistributable for Visual Studio 2017 [64-bit](https://aka.ms/vs/15/release/VC_redist.x64.exe) / [32-bit](https://aka.ms/vs/15/release/VC_redist.x86.exe)
	1. [WampServer](http://www.wampserver.com/)
	1. [Git](https://git-scm.com)
	1. [Composer](https://getcomposer.org)
	1. [Node.js 8](https://nodejs.org)
	1. [Yarn package manager](https://yarnpkg.com)
1. Open Git Bash and run the following command to generate SSH key pair:

		ssh-keygen -t rsa -b 2048

1. Add the created `id_rsa.pub` SSH key to your GitHub account
1. In Git bash navigate to the `www` directory in the WAMP

		# e.g.
		cd /c/wamp64/www

1. Then run following commands in Git Bash:

		git clone git@github.com:ISCCTU/iscweb.git
		cd iscweb
		composer install
		yarn install
		yarn run development
		cp .env.example .env
		php artisan key:generate

1. Open the `.env` file and change the database credintials

		DB_USERNAME=root
		DB_PASSWORD=

1. Set up the Apache HTTP server
	1. Start WAMP
	1. Switch the PHP version to PHP 7
		1. Left click on a WAMP icon in the system tray
		1. PHP -> Version -> 7.0.x
	1. Open your Internet browser
	1. Into the address bar enter `localhost`
	1. Click on `Add a Virtual Host`
	1. Fill the required fields (e.g. name: `iscweb`, complete path: `C:/wamp64/www/iscweb/public`)
	1. Crete Virtual Host
	1. Right click on a WAMP icon in the system tray
	1. Tools -> Restart DNS
1. Import the ISC database
	1. Into the address bar enter `localhost`
	1. On the page that just loaded click on `adminer`
	1. Log in to the database (Username: `root`, no password)
	1. Click `Import` and import the file you will get from IT Coordinator

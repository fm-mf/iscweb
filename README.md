ESN web
=======

Technologies used
-----------------

- [Laravel framework v8.x][laravel]
- [Bootstrap v4.x][bootstrap]
- [Vue.js v2][vuejs]


Requirements
------------

- [Apache HTTP server 2.4][apache] or [Nginx][nginx]
- [MySQL 5.7.7][mysql] or higher (or [Maria DB 10.2.2][mariadb] or newer)
- [PHP 7.4][php]
- [Composer][composer]
- [Node.js 16][nodejs] or higher (current LTS release is recommended)
- [Yarn package manager v1 (Classic)][yarn]


Installation
------------

### Linux

1. Install and configure Apache + MySQL + PHP (see [this guide][do-setup-lamp-20.04] for Ubuntu 20.04 instructions)
	- After step 3, when finished installing PHP, install the following PHP extensions:
		`mbstring`,
		`xml`,
		`gd`,
		`zip`,
		`gmp`

			sudo apt install php-{mbstring,xml,gd,zip,gmp}

	- Skip steps 4 and 5
	- In step 6, when creating a user and a database, use `isc` for the database name, user name and password
		- You do not have to create any tables or insert any data

2. Then install:
	- [Git][git]
	- [Composer][composer-download]
	- [Node.js][nodesource] – current LTS release is recommended
	- [Yarn package manager v1][yarn-install]

3. Generate SSH public/private key pair
	1. In terminal run

			ssh-keygen -t rsa -b 2048

	2. Add content of the created `id_rsa.pub` SSH key to your [GitHub account][github-new-ssh]

4. In terminal navigate to the directory in which you want the ESN CTU web sources to be downloaded

5. Then run the following commands in terminal:

		git clone git@github.com:ISCCTU/iscweb.git
		cd iscweb
		sudo ln -snfr . /var/www/iscweb
		composer install
		yarn install
		yarn run development
		cp .env.example .env
		php artisan key:generate


6. Open the `.env` file and change the database credentials to match those set during MySQL setup

		DB_DATABASE=isc
		DB_USERNAME=isc
		DB_PASSWORD=isc


7. Set up the Apache virtualhost by placing the following in `/etc/apache2/sites-available/iscweb.conf` file

		<VirtualHost *:80>
			ServerName iscweb.test

			# Path to the public folder in iscweb local repo, e.g.
			DocumentRoot /var/www/iscweb/public
			<Directory /var/www/iscweb/public>
				AllowOverride All
				Require local
			</Directory>
		</VirtualHost>

	then enable the site and reload Apache server

		echo "127.0.0.1	iscweb.test" | sudo tee -a /etc/hosts >/dev/null
		sudo a2ensite iscweb
		sudo systemctl reload apache2


8. If you don't have `mod_rewrite` enabled, then run the following commands in terminal:

		sudo a2enmod rewrite
		sudo systemctl restart apache2


9. Populate the ESN database by running the following command in terminal from your project directory

		php artisan migrate --seed



### Windows

1. Download and install:
	1. Visual C++ Redistributable for Visual Studio 2012 [64-bit][vc2012x64] / [32-bit][vc2012x86]
	2. Visual C++ Redistributable for Visual Studio 2015-2019 [64-bit][vc2015x64] / [32-bit][vc2015x86]
	3. [WampServer][wamp]
		- For PHP versions, make sure, PHP 7.4 is selected to install
		- For MySQL version, select version 8.0
	4. [Git][git]
	5. [Composer][composer-download]
		- When asked which PHP version to use, select version 7.4 (or any newer if 7.4 is not available)
	6. [Node.js][nodejs] – current LTS release is recommended
	7. [Yarn package manager v1][yarn-install]

2. Open Git Bash and run the following command to generate SSH key pair:

		ssh-keygen -t rsa -b 2048


3. Add content of the created `id_rsa.pub` SSH key to your [GitHub account][github-new-ssh]

4. In Git Bash navigate to the `www` directory of the WAMP server, e.g.

		cd /c/wamp64/www


5. Then run following commands in Git Bash:

		git clone git@github.com:ISCCTU/iscweb.git
		cd iscweb
		composer install
		yarn install
		yarn run development
		cp .env.example .env
		php artisan key:generate


6. Open the `.env` file and change the database credentials

		DB_DATABASE=isc
		DB_USERNAME=root
		DB_PASSWORD=


7. Set up the Apache HTTP server
	1. Start WAMP
	2. Switch the PHP version to PHP 7.4
		1. Left-click on a WAMP icon in the system tray
		2. PHP -> Version -> 7.4.x
		3. Right-click on a WAMP icon in the system tray
		4. Tools -> Change PHP CLI version -> 7.4.x
	3. Open your Internet browser
	4. Into the address bar enter `localhost`
	5. Click on `Add a Virtual Host`
	6. Fill in the required fields (e.g. name: `iscweb`, complete path: `C:/wamp64/www/iscweb/public`)
	7. Crete Virtual Host
	8. Right-click on a WAMP icon in the system tray
	9. Tools -> Restart DNS

8. Create the ESN database
	1. In Windows Explorer navigate to the `C:\wamp64\apps\adminerX.X.X\` directory
	2. Open file `index.php` and at the beginning of the file change the line

			$AcceptEmptyPassword = false;

		to

			$AcceptEmptyPassword = true;

	3. Save the file
	4. Open your Internet browser and navigate to `localhost/adminer`
	5. Log in to the database using the default credentials (username = `root`, no password)
	6. Click 'Create database' and enter the name of the new database (e.g. `isc`), for collation select `utf8mb4_unicode_520_ci` and click on 'Save'
	7. Change default storage engine of MySQL from MYISAM to InnoDB
		1. Left-click on the WAMP icon in the system tray
		2. MySQL -> my.ini
		3. In the file which opens, change the following line

				default-storage-engine=MYISAM

			to

				default-storage-engine=InnoDB

			and save the file
		4. Left-click on the WAMP icon in the system tray
		5. MySQL -> Service administration 'wampmysqld64' -> Restart service

9. To populate the ESN database, open Git Bash in the project directory and run the following command

		php artisan migrate --seed


[apache]: https://httpd.apache.org 'Apache HTTP server'
[bootstrap]: https://getbootstrap.com 'Bootstrap · The most popular HTML, CSS, and JS library in the world.'
[composer]: https://getcomposer.org 'Composer – A dependency manager for PHP'
[composer-download]: https://getcomposer.org/download 'Composer – A dependency manager for PHP'
[do-setup-lamp-20.04]: https://www.digitalocean.com/community/tutorials/how-to-install-linux-apache-mysql-php-lamp-stack-on-ubuntu-20-04 'How to install Linux, Apache, MySQL, PHP (LAMP) stack on Ubuntu 20.04'
[git]: https://git-scm.com 'Git'
[github-new-ssh]: https://github.com/settings/ssh/new 'Add new SSH keys | GitHub'
[laravel]: https://laravel.com/docs/8.x 'Laravel – The PHP framework for web artisans'
[mariadb]: https://mariadb.org/ 'MariaDB Server: The open source relational database'
[mysql]: https://www.mysql.com 'MySQL'
[nginx]: https://www.nginx.com 'Nginx – High Performance Load Balancer, Web Server, & Reverse Proxy'
[nodejs]: https://nodejs.org 'Node.js – A JavaScript runtime built on Chrome\'s V8 JavaScript engine'
[nodesource]: https://github.com/nodesource/distributions/blob/master/README.md#debinstall 'NodeSource Node.js binary distribution'
[php]: https://www.php.net 'PHP: Hypertext preprocessor'
[vc2012x64]: https://download.microsoft.com/download/1/6/B/16B06F60-3B20-4FF2-B699-5E9B7962F9AE/VSU_4/vcredist_x64.exe 'Visual C++ Redistributable for Visual Studio 2012 (64-bit)'
[vc2012x86]: https://download.microsoft.com/download/1/6/B/16B06F60-3B20-4FF2-B699-5E9B7962F9AE/VSU_4/vcredist_x86.exe 'Visual C++ Redistributable for Visual Studio 2012 (32-bit)'
[vc2015x64]: https://aka.ms/vs/16/release/vc_redist.x64.exe 'Visual C++ Redistributable for Visual Studio 2015-2019 (64-bit)'
[vc2015x86]: https://aka.ms/vs/16/release/VC_redist.x86.exe 'Visual C++ Redistributable for Visual Studio 2015-2019 (32-bit)'
[vuejs]: https://vuejs.org 'Vue.js – The progressive JavaScript framework'
[wamp]: https://sourceforge.net/projects/wampserver 'WAMP server'
[yarn]: https://classic.yarnpkg.com 'Yarn – Node package manager'
[yarn-install]: https://classic.yarnpkg.com/docs/install 'Yarn – Node package manager'

# Crawler Seminovos BH

This project is responsible for crawling [this web page](https://www.seminovosbh.com.br/resultadobusca/index/veiculo/carro/marca/BMW/modelo/1239/usuario/todos) 
given by Seminovos BH and get from this page the 'children' links, and then crawl these links looking for vehicles' data, such as, brand, price and so on . 

## Getting Started

Just in the first page of the App, It is shown an introduction and a table. The table's rows represents each child link recovered from the first page given by Seminovos BH. To start the crawler and see the data recovered from each of this links (rows), it is necessary to click the blue button in the panel.

As soon as you click the button, the table will be automatically filled by the data. Each row (URL)will receive their respective data and it will says if the process of crawling was a success or not.  


### Prerequisites

This application was build in Laravel with Docker. To run this application a [run.sh](/run.sh) file must be called and inner this file, there 
are the commands necessary to run the application and upload docker's services.

This Shell Script can be run in all environments: Linux, Mac and Windows. On Windows you will need git bash and on Mac you need to 
use the bash prefix before running the script.

Summing up, if you a a Docker Lover you just need to install Docker. But if you want to run locally, you need Laravel and its Prerequisites.

A quick reminder, the port 3306 and 80 are used by the mysql-container and nginx container 
respectively, both in local machine and in the containers themselfs. So to run this application locally ou even in your docker, stop services that could be using these ports or change the [docker-compose.yml](/docker-compose.yml) to not use these portes mencioned before.

#### Prerequisites with DOCKER

To run docker in your machine, for each of the Operating System (OS) below you need some requirements.

##### Windows

* Windows 10 64bit: Pro, Enterprise or Education (1607 Anniversary Update, Build 14393 or later);
* Virtualization is enabled in BIOS. Typically, virtualization is enabled by default. This is different from having Hyper-V enabled. For more detail see Virtualization must be enabled in Troubleshooting;
* CPU SLAT-capable feature;
* At least 4GB of RAM.

Note: If your system does not meet the requirements to run Docker for Windows, you can install Docker Toolbox, which uses Oracle Virtual Box instead of Hyper-V.

##### Linux (Ubuntu)

To install Docker CE, you need the 64-bit version of one of these Ubuntu versions:

* Bionic 18.04 (LTS)
* Xenial 16.04 (LTS)
* Trusty 14.04 (LTS)

Docker CE is supported on Ubuntu on x86_64, armhf, s390x (IBM Z), and ppc64le (IBM Power) architectures.

##### Installing

If you have the requirements needed access the installation guide from Docker according to you OS.

* [windows-guide](https://docs.docker.com/docker-for-windows/install/#what-to-know-before-you-install)

* [mac-guide](https://docs.docker.com/docker-for-mac/)

* [linux-guide-ubuntu](https://docs.docker.com/install/linux/docker-ce/ubuntu/)


#### Prerequisites with LARAVEL

You will need to make sure your server meets the following requirements:

* PHP >= 7.1.3
* OpenSSL PHP Extension
* PDO PHP Extension
* Mbstring PHP Extension
* Tokenizer PHP Extension
* XML PHP Extension
* Ctype PHP Extension
* JSON PHP Extension
* BCMath PHP Extension

##### Install composer

* [linux-mac](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos);
* [windows](https://getcomposer.org/doc/00-intro.md#installation-windows).

##### Running this project

Clone this project to a folder in your local machine:

```
git clone (https://github.com/dwolopes/crawler-php.git)
```

After clone, run the follow command inside the recent created folder

```
composer install
```

Following that, create the key of the laravel project

```
php artisan key:generate
```

Least, but not least create the database and its tables

```
php artisan migrate
```

Open in your browser the link to your localhost using 80 port.


## Built With

* [Laravel 5.7](https://laravel.com/docs/5.7) - The web framework used
* [Docker](https://www.docker.com/) - A tool designed to make it easier to create, deploy, and run applications by using containers. 
* [dom_crawler-symfony](https://symfony.com/doc/current/components/dom_crawler.html) - Used to crawl the URLs, the core of the project

## Contributing

Please read [CONTRIBUTING.md](CONTRIBUTING.md) for details on our code of conduct, and the process for submitting pull requests to us.

## Authors

* **Douglas Lopes** - *Initial work* - [crawler-php](https://github.com/dwolopes/crawler-php/)

See also the list of [contributors](https://github.com/dwolopes/crawler-php/graphs/contributors who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details
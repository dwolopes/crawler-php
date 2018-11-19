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

### Prerequisites with DOCKER

To run docker in your machine, for each of the Operating System (OS) below you need some requirements.

#### Windows

* Windows 10 64bit: Pro, Enterprise or Education (1607 Anniversary Update, Build 14393 or later);
* Virtualization is enabled in BIOS. Typically, virtualization is enabled by default. This is different from having Hyper-V enabled. For more detail see Virtualization must be enabled in Troubleshooting;
* CPU SLAT-capable feature;
* At least 4GB of RAM.

Note: If your system does not meet the requirements to run Docker for Windows, you can install Docker Toolbox, which uses Oracle Virtual Box instead of Hyper-V.

#### Linux (Ubuntu)

To install Docker CE, you need the 64-bit version of one of these Ubuntu versions:

* Bionic 18.04 (LTS)
* Xenial 16.04 (LTS)
* Trusty 14.04 (LTS)

Docker CE is supported on Ubuntu on x86_64, armhf, s390x (IBM Z), and ppc64le (IBM Power) architectures.

### Installing

If you have the requirements needed access the installation guide from Docker according to you OS.

* [windows-guide](https://docs.docker.com/docker-for-windows/install/#what-to-know-before-you-install)

* [mac-guide](https://docs.docker.com/docker-for-mac/)

* [linux-guide-ubuntu](https://docs.docker.com/install/linux/docker-ce/ubuntu/)

Say what the step will be

```
Give the example
```

And repeat

```
until finished
```

End with an example of getting some data out of the system or using it for a little demo
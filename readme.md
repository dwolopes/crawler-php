# Crawler Seminovos BH

This project is responsible for crawling [this web page](https://www.seminovosbh.com.br/resultadobusca/index/veiculo/carro/marca/BMW/modelo/1239/usuario/todos) 
given by Seminovos BH and get from this page the 'children' links, and then crawl these 'children' links looking for vehicles' data, such as, brand, price and so on . 

## Getting Started

Just in the first page of the App, It is shown an introduction and a table. The table's rows represents each child 
link recovered from the first page given by Seminovos BH. To start the crawler and see the data recovered from each of 
this links (rows), it is necessary to click the blue button in the panel.

As soon as you click the button, the table will be automatically filled by the data crawler. Each row (URL) will receive 
their respective data and it will says if the process of crawling was a success.  


### Prerequisites

This application was build in Laravel and Docker. To run this application a [run.sh](/run.sh) file is called and inner this file, there 
are the commands necessary to run the application and upload docker's services.

This Shell Script can be run in all environments: Linux, Mac and Windows. On Windows you will need git bash and on Mac you need to 
use the bash prefix before running the script.

Summing up, if you a a Docker Lover you just need to install Docker. But if you want to run locally, you need Laravel and its Prerequisites.
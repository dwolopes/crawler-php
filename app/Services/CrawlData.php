<?php

namespace  App\Services;


// lib used to crawl

use Symfony\Component\DomCrawler\Crawler;

class CrawlData
{

    const url = 'https://www.seminovosbh.com.br/resultadobusca/index/veiculo/carro/marca/BMW/modelo/1239/usuario/todos';


    // Method responsible for getting the children links from the first Page - the const URL - the first URL given in te exercise.
    static public function getLinksFirstPage(){
        $html = file_get_contents(self::url);
        $crawlerFirstPage = new Crawler($html, 'https://www.seminovosbh.com.br/');

        $nodeValues = $crawlerFirstPage->filter('.titulo-busca > a')->each(function (Crawler $node, $i) {
            return $node->link()->getUri();
        });

        return $nodeValues;
    }


    // This method helps the Urlcontroller format the children's url to insert them into the database.
    static  public  function formatUrl($url) {
        $linkParsed = parse_url($url);

        $arrayLinkParsed = explode("/", $linkParsed['path']);

        $formatedUrl = $linkParsed["scheme"] . "://" . $linkParsed["host"] .
                        "/" . $arrayLinkParsed[1] . "/" . $arrayLinkParsed[2] . "/" . $arrayLinkParsed[3]
                        . "/" . $arrayLinkParsed[4] . "/" . $arrayLinkParsed[5];

        return $formatedUrl;

    }

    /**
     * This function allows recover some information from the URL instead to recover them from the HTML page, which is slower.
     */
    static  public  function getGeneralDataFromUrl($url) {
        $linkParsed = parse_url($url);

        $arrayLinkParsed = explode("/", $linkParsed['path']);

        array_shift($arrayLinkParsed);

        $arraResulted = [
            "tipo_anuncio" => $arrayLinkParsed[0],
            "marca" => $arrayLinkParsed[1],
            "modelo" => $arrayLinkParsed[2],
            "ano" => $arrayLinkParsed[3],
            "id_veiculo" => $arrayLinkParsed[4]
        ];

        return $arraResulted;
    }

    // Crawl and get data that is not in the URL from the page being crawled. It crawls the HTML of the page.
    public function getDataDetails($urlToInspect){

        $html = file_get_contents($urlToInspect);
        $crawler = new Crawler($html, 'https://www.seminovosbh.com.br/');
        $crawler = $crawler->filter('#textoBoxVeiculo > p');
        return $crawler->text();

    }
}
<?php

namespace  App\Services;

use Symfony\Component\DomCrawler\Crawler;

class CrawlData
{

    const url = 'https://www.seminovosbh.com.br/resultadobusca/index/veiculo/carro/marca/BMW/modelo/1239/usuario/todos';


    static public function getLinksFirstPage(){
        $html = file_get_contents(self::url);
        $crawlerFirstPage = new Crawler($html, 'https://www.seminovosbh.com.br/');

        $nodeValues = $crawlerFirstPage->filter('.titulo-busca > a')->each(function (Crawler $node, $i) {
            return $node->link()->getUri();
        });

        return $nodeValues;
    }

    static  public  function formatUrl($url) {
        $linkParsed = parse_url($url);

        $arrayLinkParsed = explode("/", $linkParsed['path']);

        $formatedUrl = $linkParsed["scheme"] . "://" . $linkParsed["host"] .
                        "/" . $arrayLinkParsed[1] . "/" . $arrayLinkParsed[2] . "/" . $arrayLinkParsed[3]
                        . "/" . $arrayLinkParsed[4] . "/" . $arrayLinkParsed[5];

        return $formatedUrl;

    }

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

    public function getDataDetails($urlToInspect){

        $html = file_get_contents($urlToInspect);
        $crawler = new Crawler($html, 'https://www.seminovosbh.com.br/');
        $crawler = $crawler->filter('#textoBoxVeiculo > p');
        return $crawler->text();

    }
}
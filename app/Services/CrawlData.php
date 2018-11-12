<?php

namespace  App\Services;

use Symfony\Component\DomCrawler\Crawler;

class CrawlData
{

    const url = 'https://www.seminovosbh.com.br/resultadobusca/index/veiculo/carro/marca/BMW/modelo/1239/usuario/todos';

    static public function getLinksFirstPage(){
        $html = file_get_contents(self::url);
        $crawler = new Crawler($html, 'https://www.seminovosbh.com.br/');

        $nodeValues = $crawler->filter('.titulo-busca > a')->each(function (Crawler $node, $i) {
            return $node->link()->getUri();
        });

        return $nodeValues;
    }

}
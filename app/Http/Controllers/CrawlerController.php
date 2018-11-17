<?php

namespace App\Http\Controllers;

use App\Entities\CrawlerData;
use App\Entities\Url;
use Illuminate\Http\Request;
use function PHPSTORM_META\type;
use Symfony\Component\DomCrawler\Crawler;
use App\Services\CrawlData;
use NumberFormatter;

class CrawlerController extends Controller
{

    /**
     * @var crawlDataService
     */
    private $crawlDataService;

    /**
     * CrawlerController constructor.
     */
    public function __construct(CrawlData $crawlDataService) 
    {
        $this->crawlDataService = $crawlDataService;
    }

    /**
     * This method is calles by the Ajax in the Js file. For each URL stored in the URL table,
     * It is called @getGeneralDataFromUrl, service responsible for getting the data crawling the HTML page.
     * Aftwards, those data recovered from the HTML page are stored in the database.
     *
     * @return \Illuminate\Http\Response
     */

    public function crawlStore(Request $request)
    {

            $price = $this->crawlDataService->getDataDetails($request->url);
            $arrayGeneralData = CrawlData::getGeneralDataFromUrl($request->url);
            $formattedPrice  = floatval(preg_replace("/[^0-9,\,]/", "", $price));
            $yearsArray = explode("-", $arrayGeneralData['ano']);

            $crawlData = CrawlerData::create([
                "url_id" => $request->id,
                "marca" =>  $arrayGeneralData['marca'],
                "modelo" => $arrayGeneralData['modelo'],
                "ano_fabricacao" => $yearsArray['0'],
                "ano_modelo" => $yearsArray['1'],
                "preco" => $formattedPrice,
                "veiculo_id" => $arrayGeneralData['id_veiculo'],
            ]);

            return response()->json($crawlData);
    }

}

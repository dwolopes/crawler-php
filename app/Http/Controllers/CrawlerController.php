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
    public function __construct(CrawlData $crawlDataService) {
        $this->crawlDataService = $crawlDataService;
    }

    /**
     * Show the form for creating a new resource. For each URL stored in the database
     * Its called @getGeneralDataFromUrl, responsible for get the data crawling the HTML page.
     * Aftwards, those data recovered from the HTML page is stored in the database.
     *
     * @return \Illuminate\Http\Response
     */
    public function crawl(Request $request)
    {
        $savedUrls = Url::all();
        foreach ($savedUrls as $url){
            $price = $this->crawlDataService->getDataDetails($url->url);
            $arrayGeneralData = CrawlData::getGeneralDataFromUrl($url->url);
            $formattedPrice  = floatval(preg_replace("/[^0-9,\,]/", "", $price));
            $yearsArray = explode("-", $arrayGeneralData['ano']);

            CrawlerData::create([
                "url_id" => $url->id,
                "marca" =>  $arrayGeneralData['marca'],
                "modelo" => $arrayGeneralData['modelo'],
                "ano_fabricacao" => $yearsArray['0'],
                "ano_modelo" => $yearsArray['1'],
                "preco" => $formattedPrice,
                "veiculo_id" => $arrayGeneralData['id_veiculo'],
            ]);
        }
    }


    /**
     * Show the form for creating a new resource. For each URL stored in the database
     * Its called @getGeneralDataFromUrl, responsible for get the data crawling the HTML page.
     * Aftwards, those data recovered from the HTML page is stored in the database.
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Entities\CrawlerData;
use App\Entities\Url;
use Illuminate\Http\Request;
use Symfony\Component\DomCrawler\Crawler;
use App\Services\CrawlData;


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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        // Once the Url table is populated, its not necessary to crawl the first page of seminovosbh again
        $links = Url::all();

        if(count($links) == 0){
            $firstLinks = CrawlData::getLinksFirstPage();
            foreach ($firstLinks as $link){
                $formattedUrl = CrawlData::formatUrl($link);
                Url::create(['url' => $formattedUrl]);
            }
        }

        return view('welcome');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function crawl(Request $request)
    {
        $savedUrls = Url::all();
        foreach ($savedUrls as $url){
            $price = $this->crawlDataService->getDataDetails($url->url);
            $arrayGeneralData = CrawlData::getGeneralDataFromUrl($url->url);

            return gettype($price);
        }

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

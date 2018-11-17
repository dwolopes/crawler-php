<?php

namespace App\Http\Controllers;

use App\Entities\Url;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Services\CrawlData;

/**
 * Class UrlsController.
 *
 * @package namespace App\Http\Controllers;
 */
class UrlsController extends Controller
{

    /**
     * Store the children URLs from the firts page. To exec this method, it is necessary to crawl
     * the father page first which is made by the method below.
     *
     *
     * @return \Illuminate\Http\Response
     */
    private function store($url)
    {
        Url::create(['url' => $url]);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $url,
            ]);
        }
    }

    /**
     * This method is responsible for calling the service which is responsible for crawling
     * the first page passed in the exercise. The returned URL is passed to the private method 
     * Store in the same class, which is responsible for saving the data into  its Urls Table.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // Check if the data already exists in the table.
        $links = Url::all();

        // Once the Url table is populated, its not necessary to crawl the first page of seminovosbh again.
        if(count($links) == 0){
            $firstLinks = CrawlData::getLinksFirstPage();
            foreach ($firstLinks as $link){
                $formattedUrl = CrawlData::formatUrl($link);
                if (!empty($formattedUrl)) {
                    $this->store($formattedUrl);
                }
            }

            $links = Url::all();
        }

        return view('pages.url', compact('links'));
    }

    /**
     * This method is called by the Fetch API Function inside a JS file, it returns all children URLs 
     * saved in the URL Table.
     * 
     * @return \Illuminate\Http\Response
     */
    public function getUrls() {
        $links = Url::select('id', 'url')->get();

        if(count($links) > 0){
            return response()->json($links);
        } else {
            return response()->json([]);
        }
    }
}

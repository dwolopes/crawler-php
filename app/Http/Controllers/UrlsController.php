<?php

namespace App\Http\Controllers;

use App\Entities\Url;
use http\Env\Response;
use Illuminate\Http\Request;

/**
 * Class UrlsController.
 *
 * @package namespace App\Http\Controllers;
 */
class UrlsController extends Controller
{

    /**
     * Display the resource.
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
     * the first page passed in the exercise. This service returns just de children URL which
     * will be cralwed when the user click on "Crawl" the method crawl is activaded.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $links = Url::all();

        // Once the Url table is populated, its not necessary to crawl the first page of seminovosbh again
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

    public function getUrls() {
        $links = Url::select('id', 'url')->get();

        if(count($links) > 0){
            return response()->json($links);
        } else {
            return response()->json([]);
        }
    }
}

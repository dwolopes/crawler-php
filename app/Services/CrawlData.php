<?php

namespace  App\Services;

use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;
use Spatie\Crawler\CrawlObserver;
use Spatie\LinkChecker\Reporters\BaseReporter;

class CrawlData extends BaseReporter
{


    public function crawlFailed(
        UriInterface $url,
        RequestException $requestException,
        ?UriInterface $foundOnUrl = null
    ){
        parent::crawlFailed($url, $requestException, $foundOnUrl);

        $statusCode = $requestException->getCode();

        if ($this->isExcludedStatusCode($statusCode)) {
            return;
        }
    }

    public function finishedCrawling()
    {
        collect($this->urlsGroupedByStatusCode)
            ->each(function ($urls, $statusCode) {
                if ($this->isSuccessOrRedirect($statusCode)) {
                    return;
                }

                $count = count($urls);

                if ($statusCode == static::UNRESPONSIVE_HOST) {
                    return;
                }

                return $count;

            });
    }


    /**
     * Called when the crawler has crawled the given url successfully.
     *
     * @param \Psr\Http\Message\UriInterface $url
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param \Psr\Http\Message\UriInterface|null $foundOnUrl
     */
    /**
     * Called when the crawler has crawled the given url successfully.
     *
     * @param \Psr\Http\Message\UriInterface $url
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param \Psr\Http\Message\UriInterface|null $foundOnUrl
     */
     public function crawled(
        UriInterface $url,
        ResponseInterface $response,
        ?UriInterface $foundOnUrl = null
    ){
        $statusCode = $response->getStatusCode();

        if ($this->isExcludedStatusCode($statusCode)) {
            return;
        }

    }

}
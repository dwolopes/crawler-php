<?php

namespace App\Presenters;

use App\Transformers\CrawlerDataTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class CrawlerDataPresenter.
 *
 * @package namespace App\Presenters;
 */
class CrawlerDataPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new CrawlerDataTransformer();
    }
}

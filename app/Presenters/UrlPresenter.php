<?php

namespace App\Presenters;

use App\Transformers\UrlTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class UrlPresenter.
 *
 * @package namespace App\Presenters;
 */
class UrlPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new UrlTransformer();
    }
}

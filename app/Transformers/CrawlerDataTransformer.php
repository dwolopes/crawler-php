<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\CrawlerData;

/**
 * Class CrawlerDataTransformer.
 *
 * @package namespace App\Transformers;
 */
class CrawlerDataTransformer extends TransformerAbstract
{
    /**
     * Transform the CrawlerData entity.
     *
     * @param \App\Entities\CrawlerData $model
     *
     * @return array
     */
    public function transform(CrawlerData $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}

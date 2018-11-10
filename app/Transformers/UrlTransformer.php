<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Url;

/**
 * Class UrlTransformer.
 *
 * @package namespace App\Transformers;
 */
class UrlTransformer extends TransformerAbstract
{
    /**
     * Transform the Url entity.
     *
     * @param \App\Entities\Url $model
     *
     * @return array
     */
    public function transform(Url $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}

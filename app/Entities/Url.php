<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Url.
 *
 * @package namespace App\Entities;
 */
class Url extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "urls";

    protected $fillable = [
        "url",
    ];

    /**
     * Get the phone record associated with the user.
     */
    public function getDataUrl()
    {
        return $this->hasOne('CrawlerData', 'url_id');
    }

}

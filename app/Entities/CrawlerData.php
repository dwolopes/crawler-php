<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class CrawlerData.
 *
 * @package namespace App\Entities;
 */
class CrawlerData extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = "crawler-data";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "url_id",
        "marca",
        "modelo",
        "ano_fabricacao",
        "ano_modelo",
        "preco",
        "veiculo_id"
    ];

    /**
     * Get the user that owns the phone.
     */
    public function user()
    {
        return $this->belongsTo('Url', 'id');
    }

}

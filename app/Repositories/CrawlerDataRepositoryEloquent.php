<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\CrawlerDataRepository;
use App\Entities\CrawlerData;
use App\Validators\CrawlerDataValidator;

/**
 * Class CrawlerDataRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CrawlerDataRepositoryEloquent extends BaseRepository implements CrawlerDataRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CrawlerData::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return CrawlerDataValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}

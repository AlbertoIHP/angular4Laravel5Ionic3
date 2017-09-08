<?php

namespace App\Repositories;

use App\Models\Car;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CarRepository
 * @package App\Repositories
 * @version September 8, 2017, 2:12 am UTC
 *
 * @method Car findWithoutFail($id, $columns = ['*'])
 * @method Car find($id, $columns = ['*'])
 * @method Car first($columns = ['*'])
*/
class CarRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'model',
        'year',
        'users_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Car::class;
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCarAPIRequest;
use App\Http\Requests\API\UpdateCarAPIRequest;
use App\Models\Car;
use App\Repositories\CarRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class CarController
 * @package App\Http\Controllers\API
 */

class CarAPIController extends AppBaseController
{
    /** @var  CarRepository */
    private $carRepository;

    public function __construct(CarRepository $carRepo)
    {
        $this->carRepository = $carRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/cars",
     *      summary="Get a listing of the Cars.",
     *      tags={"Car"},
     *      description="Get all Cars",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Car")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $this->carRepository->pushCriteria(new RequestCriteria($request));
        $this->carRepository->pushCriteria(new LimitOffsetCriteria($request));
        $cars = $this->carRepository->all();

        return $this->sendResponse($cars->toArray(), 'Cars retrieved successfully');
    }

    /**
     * @param CreateCarAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/cars",
     *      summary="Store a newly created Car in storage",
     *      tags={"Car"},
     *      description="Store Car",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Car that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Car")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Car"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateCarAPIRequest $request)
    {
        $input = $request->all();

        $cars = $this->carRepository->create($input);

        return $this->sendResponse($cars->toArray(), 'Car saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/cars/{id}",
     *      summary="Display the specified Car",
     *      tags={"Car"},
     *      description="Get Car",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Car",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Car"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var Car $car */
        $car = $this->carRepository->findWithoutFail($id);

        if (empty($car)) {
            return $this->sendError('Car not found');
        }

        return $this->sendResponse($car->toArray(), 'Car retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateCarAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/cars/{id}",
     *      summary="Update the specified Car in storage",
     *      tags={"Car"},
     *      description="Update Car",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Car",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Car that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Car")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Car"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateCarAPIRequest $request)
    {
        $input = $request->all();

        /** @var Car $car */
        $car = $this->carRepository->findWithoutFail($id);

        if (empty($car)) {
            return $this->sendError('Car not found');
        }

        $car = $this->carRepository->update($input, $id);

        return $this->sendResponse($car->toArray(), 'Car updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/cars/{id}",
     *      summary="Remove the specified Car from storage",
     *      tags={"Car"},
     *      description="Delete Car",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Car",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var Car $car */
        $car = $this->carRepository->findWithoutFail($id);

        if (empty($car)) {
            return $this->sendError('Car not found');
        }

        $car->delete();

        return $this->sendResponse($id, 'Car deleted successfully');
    }
}

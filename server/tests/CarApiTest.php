<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CarApiTest extends TestCase
{
    use MakeCarTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateCar()
    {
        $car = $this->fakeCarData();
        $this->json('POST', '/api/v1/cars', $car);

        $this->assertApiResponse($car);
    }

    /**
     * @test
     */
    public function testReadCar()
    {
        $car = $this->makeCar();
        $this->json('GET', '/api/v1/cars/'.$car->id);

        $this->assertApiResponse($car->toArray());
    }

    /**
     * @test
     */
    public function testUpdateCar()
    {
        $car = $this->makeCar();
        $editedCar = $this->fakeCarData();

        $this->json('PUT', '/api/v1/cars/'.$car->id, $editedCar);

        $this->assertApiResponse($editedCar);
    }

    /**
     * @test
     */
    public function testDeleteCar()
    {
        $car = $this->makeCar();
        $this->json('DELETE', '/api/v1/cars/'.$car->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/cars/'.$car->id);

        $this->assertResponseStatus(404);
    }
}

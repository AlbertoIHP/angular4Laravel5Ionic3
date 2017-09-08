<?php

use App\Models\Car;
use App\Repositories\CarRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CarRepositoryTest extends TestCase
{
    use MakeCarTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var CarRepository
     */
    protected $carRepo;

    public function setUp()
    {
        parent::setUp();
        $this->carRepo = App::make(CarRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateCar()
    {
        $car = $this->fakeCarData();
        $createdCar = $this->carRepo->create($car);
        $createdCar = $createdCar->toArray();
        $this->assertArrayHasKey('id', $createdCar);
        $this->assertNotNull($createdCar['id'], 'Created Car must have id specified');
        $this->assertNotNull(Car::find($createdCar['id']), 'Car with given id must be in DB');
        $this->assertModelData($car, $createdCar);
    }

    /**
     * @test read
     */
    public function testReadCar()
    {
        $car = $this->makeCar();
        $dbCar = $this->carRepo->find($car->id);
        $dbCar = $dbCar->toArray();
        $this->assertModelData($car->toArray(), $dbCar);
    }

    /**
     * @test update
     */
    public function testUpdateCar()
    {
        $car = $this->makeCar();
        $fakeCar = $this->fakeCarData();
        $updatedCar = $this->carRepo->update($fakeCar, $car->id);
        $this->assertModelData($fakeCar, $updatedCar->toArray());
        $dbCar = $this->carRepo->find($car->id);
        $this->assertModelData($fakeCar, $dbCar->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteCar()
    {
        $car = $this->makeCar();
        $resp = $this->carRepo->delete($car->id);
        $this->assertTrue($resp);
        $this->assertNull(Car::find($car->id), 'Car should not exist in DB');
    }
}

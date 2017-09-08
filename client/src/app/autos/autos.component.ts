import { Component, OnInit } from '@angular/core';
import { CarService } from '../services/car.service';


@Component({
  moduleId: module.id,
  templateUrl: './autos.component.html',
  styleUrls: ['./autos.component.css']
})
export class AutosComponent implements OnInit {

	cars: any = {};

  constructor(private carService: CarService) { }

  ngOnInit() {
		console.log("Obteniendo vehiculos mediante el servicio de vehiculos");


		this.carService.getCars().subscribe(data => {
			
			this.cars = data;
			console.log(this.cars);
		});
  }

}

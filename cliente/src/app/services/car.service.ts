import { Injectable } from '@angular/core';
import { Http, Headers, RequestOptions, Response } from '@angular/http';
import { Observable } from 'rxjs';
import 'rxjs/add/operator/map';
//Se importan los modelos a utilizar
import { Car } from '../models/car';

//Servicios utilizados
import { AuthenticationService } from './authentication.service';


@Injectable()
export class CarService {

	public base: string = "http://localhost:8000/api/v1/";
	public options: RequestOptions;
	public headers: Headers;

  constructor(private http: Http,private authenticationService: AuthenticationService) 
  { 


  }

	//Este metodo obtiene los usuarios y utiliza la cabezera para el token
	getCars(): Observable<Car[]> {
		// add authorization header with jwt token

		console.log("Construyendo la cabezera con el token necesario");
		this.headers = new Headers({ 'Authorization': 'Bearer ' + this.authenticationService.token });
		this.options = new RequestOptions({ headers: this.headers });


		// get users from api

		console.log("Haciendo la peticion a la API de usuarios");
		return this.http.get(this.base+'cars', this.options).map((res: Response) => res.json());
	}


}

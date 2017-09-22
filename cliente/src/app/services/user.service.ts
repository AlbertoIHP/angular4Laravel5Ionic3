import { Injectable } from '@angular/core';
import { Http, Headers, RequestOptions, Response } from '@angular/http';
import { Observable } from 'rxjs';
import 'rxjs/add/operator/map';


//Servicios utilizados
import { AuthenticationService } from './authentication.service';

//Se importan los modelos a utilizar
import { User } from '../models/user';


@Injectable()
export class UserService {
	public base: string = "http://localhost:8000/api/v1/";
	public options: RequestOptions;
	public headers: Headers;

	//Se construyen aquellos atributos utilizados por la clase
	constructor(
		private http: Http,
		private authenticationService: AuthenticationService) {

	}


	//Este metodo obtiene los usuarios y utiliza la cabezera para el token
	getUsers(): Observable<User[]> {
		// add authorization header with jwt token

		console.log("Construyendo la cabezera con el token necesario");
		this.headers = new Headers({ 'Authorization': 'Bearer ' + this.authenticationService.token });
		this.options = new RequestOptions({ headers: this.headers });


		// get users from api

		console.log("Haciendo la peticion a la API de usuarios");
		return this.http.get(this.base+'users', this.options).map((res: Response) => res.json());
	}
}
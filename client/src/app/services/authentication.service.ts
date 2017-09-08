import { Injectable } from '@angular/core';
import { Http, Headers,RequestOptions, Response } from '@angular/http';
import { Observable } from 'rxjs';
import 'rxjs/add/operator/map'

@Injectable()
export class AuthenticationService {
	public token: string;
	public base: string = "http://localhost:8000/api/";

	constructor(private http: Http) {

		console.log("Definiendo usuario actual desde el localstorage");
		// set token if saved in local storage
		var currentUser = JSON.parse(localStorage.getItem('currentUser'));


		console.log("Guardando token para el servicio");
		this.token = currentUser && currentUser.token;
		
	}

	login(username: string, password: string): Observable<boolean> {

		
		console.log("haciendo peticion a la API...");
		console.log(JSON.stringify({ email: username, password: password }));

		console.log("Generando encabezado de contenido ");
		let headers = new Headers({ 'Content-Type': 'application/json'});
		let options = new RequestOptions({ headers: headers });

		
		return this.http.post( this.base+'login', JSON.stringify({ email: username, password: password }), options)
			.map((response: Response) => {


				// login successful if there's a jwt token in the response

				console.log("La consulta fue exitosa, formateando token...")
				let token = response.json() && response.json().token;
				if (token) {
					// set token property
					this.token = token;





					console.log("Guardando Token en el local storage");
					// store username and jwt token in local storage to keep user logged in between page refreshes
					localStorage.setItem('currentUser', JSON.stringify({ email: username, token: token }));

					// return true to indicate successful login
					return true;
				} else {
					// return false to indicate failed login
					return false;
				}
			});


	}

	logout(): void {

		console.log("Borrando token del localstorage y del servicio");
		// clear token remove user from local storage to log user out
		this.token = null;
		localStorage.removeItem('currentUser');
	}
}
import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';

import { AuthenticationService } from '../services/authentication.service';

@Component({
	moduleId: module.id,
	templateUrl: 'login.component.html'
})

export class LoginComponent implements OnInit {
	model: any = {};
	loading = false;
	error = '';

	constructor(
		private router: Router,
		private authenticationService: AuthenticationService) { }

	ngOnInit() {
		// reset login status
		console.log("Cerrando la sesion de manera inicial");
		this.authenticationService.logout();
	}

	

	login() {
		console.log("Cargando el login");
		this.loading = true;

		console.log("Haciendo la peticion mediante login, del servicio authentication");
		this.authenticationService.login(this.model.username, this.model.password)
			.subscribe(result => {

				console.log("Resultado obtenido exitosamente evaluando...")
				if (result === true) {
					console.log("redireccionando a home para listar usuarios");
					this.router.navigate(['/']);
				} else {

					console.log("Los datos son incorrectos");
					this.error = 'Username or password is incorrect';
					this.loading = false;
				}
			});
	}
}

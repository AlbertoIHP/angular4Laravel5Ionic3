import { Component, OnInit } from '@angular/core';
import { UserService } from '../services/user.service';

@Component({
	moduleId: module.id,
	templateUrl: 'home.component.html'
})

export class HomeComponent implements OnInit {
	
	users: any = {};

	constructor(private userService: UserService) { }

	ngOnInit() {
		console.log("Obteniendo usuarios mediante el servicio de usuarios");


		this.userService.getUsers().subscribe(data => {
			
			this.users = data;
			console.log(this.users);
		});


	}

}
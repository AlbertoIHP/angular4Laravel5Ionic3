import { NgModule }             from '@angular/core';
import { RouterModule, Routes } from '@angular/router';



//Se importan todos los modulos a rutear
import { LoginComponent }   from './login/login.component';
import { HomeComponent } from './home/home.component';
import { AutosComponent } from './autos/autos.component'

//Se declaran como constantes todas las rutas con sus respectivos nombres
const routes: Routes = [

	{ path: 'login',  component: LoginComponent },
	{ path: '', component: HomeComponent},
	{ path: 'autos', component: AutosComponent}

];

//Se importan las rutas declaradas como constantes, y se exportan al modulo para ser utilziados por la vista principal
@NgModule({
	imports: [ 
	RouterModule.forRoot(routes) 
	],
	exports: [ 
	RouterModule 
	]
})



export class AppRoutingModule {}


/*
Copyright 2017 Google Inc. All Rights Reserved.
Use of this source code is governed by an MIT-style license that
can be found in the LICENSE file at http://angular.io/license
*/
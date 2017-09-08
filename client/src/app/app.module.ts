//Modulose generales
import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { HttpModule } from '@angular/http';
import { FormsModule } from '@angular/forms';


//Archivo de ruteo
import { AppRoutingModule } from './app-routing.module';


//Componentes utilizados en la aplicacion
import { AppComponent } from './app.component';
import { LoginComponent } from './login/login.component';
import { HomeComponent } from './home/home.component';
import { AutosComponent } from './autos/autos.component';


//Servicios utilizados en la aplicacion
import { AuthenticationService } from './services/authentication.service';
import { UserService } from './services/user.service';
import { CarService } from './services/car.service';


@NgModule({
	//Componentes declarados
	declarations: [
		AppComponent,
		LoginComponent,
		HomeComponent,
		AutosComponent,
	],
	//Modulos declarados
	imports: [
		BrowserModule,
		AppRoutingModule,
		FormsModule,
		HttpModule
	],
	//Servicios declarados
	providers: [
		AuthenticationService,
		UserService,
		CarService
	],
	bootstrap: [
		AppComponent
	]
})
export class AppModule { }

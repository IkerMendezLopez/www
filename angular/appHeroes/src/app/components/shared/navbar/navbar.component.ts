import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { Heroe } from 'src/app/services/heroes.service';

@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
})
export class NavbarComponent implements OnInit {
  constructor( private Router: Router ) { 

  }

  ngOnInit(): void {
  }

  buscarHeroe(termino:string){
    this.Router.navigate( ['/buscar', termino] );  
  }
  


}

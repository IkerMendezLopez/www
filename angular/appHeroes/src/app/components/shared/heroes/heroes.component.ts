import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { Heroe, HeroesService } from 'src/app/services/heroes.service';

@Component({
  selector: 'app-heroes',
  templateUrl: './heroes.component.html'
})
export class HeroesComponent implements OnInit {
  heroes: Heroe[] = [];

  constructor(private _heroesService: HeroesService, private _router: Router) { 
    

  }

  //funcion que se ejecuta una vez cargada la página
  ngOnInit(): void {
    this.heroes = this._heroesService.getHeroes();
      console.log(this.heroes);
  }

  verHeroe(idx: number){
    this._router.navigate(['/heroe', idx]);
  }

  buscarHeroe(termino:string){
    const heroesARR: Heroe[]= [];
    termino = termino.toLowerCase();

    for ( const heroe of this.heroes ){
      const nombre = heroe.nombre.toLowerCase();
      if (nombre.indexOf( termino ) >= 0) {
        heroesARR.push( heroe );
      }
    }

    return heroesARR;
  }
}

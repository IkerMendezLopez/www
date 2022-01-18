import { Component, OnInit } from '@angular/core';
import { Heroe, HeroesService } from 'src/app/services/heroes.service';

@Component({
  selector: 'app-heroes',
  templateUrl: './heroes.component.html'
})
export class HeroesComponent implements OnInit {

  heroes: Heroe[] = [];

  constructor(private _heroesService: HeroesService) { }

  //funcion que se ejecuta una vez cargada la página
  ngOnInit(): void {
    this.heroes = this._heroesService.getHeroes();
      console.log(this.heroes);
  }

}

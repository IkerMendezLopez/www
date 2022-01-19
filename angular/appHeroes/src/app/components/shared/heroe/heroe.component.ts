import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { HeroesService } from 'src/app/services/heroes.service';

@Component({
  selector: 'app-heroe',
  templateUrl: './heroe.component.html'
})
export class HeroeComponent implements OnInit {

  heroe: any = {};
  constructor( private activeRoute: ActivatedRoute,
               private _heroesService: HeroesService) { 
    

    this.activeRoute.params.subscribe(params =>{
      //mostrar el id del heroe por consola
      //este id esta en app.routes.ts debemos usar el mismo nombre
      console.log(params['id']);
      this.heroe = this._heroesService.getHeroesById(params['id']);
    })
  }


  ngOnInit(): void {
  }
  
}

import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-body',
  templateUrl: './body.component.html',
  styles: [
  ]
})
export class BodyComponent implements OnInit {

  personajes: string[] = ['Calvin J. Candie', 'Butch Coolidge', 'Hans Lanbda', 'Cliff Booth', 'El Mayor Marquis Warren']
  mostrar=true;
   
  frase: any = {
    mensaje: 'Estoy a 20 minutos de alli llegare en 10',
    autor: 'Señor Lobo'
  };
  constructor() { }

  ngOnInit(): void {
  }

}

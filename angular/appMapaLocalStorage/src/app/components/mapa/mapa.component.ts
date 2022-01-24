import { Component, OnInit } from '@angular/core';
import { Marcador } from '../../classes/marcador.class';
import { MatSnackBar } from '@angular/material/snack-bar';
import { MatDialog } from '@angular/material/dialog'
import { MapaEditarComponent } from './mapa-editar.component';
@Component({
  selector: 'app-mapa',
  templateUrl: './mapa.component.html',
  styleUrls: ['./mapa.component.css']
})
export class MapaComponent implements OnInit {
  
  marcadores: Marcador[] = [];

  lat = 51.678418;
  lng = 7.809007;

  constructor(private snackbar: MatSnackBar, public dialog: MatDialog) { 
    if(localStorage.getItem("marcadores")){
      this.marcadores = JSON.parse(localStorage.getItem("marcadores") || '{}');
    }
    // const nuevoMarcador = new Marcador(51.678418, 7.809007);
    
    // this.marcadores.push(nuevoMarcador);

  }

  ngOnInit(): void {
  }

  agregarMarcador(evento:any){
    console.log(evento);

    const coords: {lat:number, lng:number} = evento.coords;

    const nuevoMarcador = new Marcador(evento.coords.lat, evento.coords.lng);
    
    this.marcadores.push(nuevoMarcador);

    this.guardarStorage();
  }

  guardarStorage(){
    localStorage.setItem('marcadores', JSON.stringify(this.marcadores));
    this.snackbar.open('Marcador agregado', 'Cerrar', {duration: 3000});
  }
  
  borrarMarcador(i:any){
    this.marcadores.splice(i,1);
    this.guardarStorage();
    this.snackbar.open('Marcador eliminado', 'Cerrar',{duration: 3000});
  }
  
  editarMarcador(marcador: Marcador){
    const dialogRef = this.dialog.open(MapaEditarComponent, {
      width: '250px',
      data: {titulo: marcador.titulo, desc: marcador.desc},
    })
  }
  
}

import { Component, OnInit } from "@angular/core";
import ficheroJSON from "../assets/ciudades.json";
import { Pais } from "./pais.js";
import { Provincia } from "./provincia.js";


@Component({
  selector: "app-root",
  templateUrl: "./app.component.html",
  styleUrls: ["./app.component.css"]
})
export class AppComponent implements OnInit {
  mensaje = "";
  paises = [];
  provincias = [];
  ciudades = [];
  mensajePais = "";
  mensajeProvincia = "";
  mensajeCiudad = "";
  verMensaje = false;
  title = "Examen Angular 2ª Evaluación";
  selectedPais: Pais = new Pais("", "");
  selectedProvincia: Provincia = new Provincia("", "");

  ngOnInit(): void {
    console.log("Leyendo el archivo Json:");
    console.log(ficheroJSON);
    ficheroJSON.forEach(elemento => {
      this.paises.push(elemento.pais);
    });
    console.log("Arreglo de Países:");
    console.log(this.paises);
    this.onSelectPais(this.selectedPais.nombre);
    this.onSelectProvincia(this.selectedProvincia.nombre);
  }

  onSelectPais(pais) {
    console.log(pais);
    if(pais == 0 ){
      this.verMensaje = false;
      this.mensajePais = '';
    }else{
      this.verMensaje = true;
      this.provincias = [];
      this.ciudades = [];
      ficheroJSON.forEach(element => {
        if (element.pais == pais) {
          this.provincias.push(element.provincia);
        }
      });
      console.log(`Provincias de ${pais}: ${this.provincias}`);
      this.mensaje = `<br>Has nacido en <b>${pais}</b>`;
      this.mensajePais = this.mensaje;
      console.log(this.mensaje);
    }

  }

  onSelectProvincia(provincia) {
    console.log(provincia);
    if(provincia == 0){
      this.verMensaje = false;
      this.mensajeProvincia = '';
    }else{
      this.verMensaje = true;
      this.ciudades = [];

      ficheroJSON.forEach(element => {
        if (element.provincia == provincia) {
          this.ciudades.push(element.ciudad);
        }
      });
      console.log(this.verMensaje);
      console.log(`Ciudades de ${provincia}: ${this.ciudades}`);
      this.mensajeProvincia = `, provincia/estado de <b>${provincia}</b>`;
    }
  }

  onSelectCiudad(ciudad) {
    if (ciudad == 0) {
      this.verMensaje = false;
      this.mensaje = '';
    } else {
      this.verMensaje = true;
      if (
        this.mensajePais.length +
          this.mensajeProvincia.length +
          this.mensajeCiudad.length >
        36
      ) {
        this.mensajeCiudad = `, en la ciudad de <b>${ciudad}</b>`;

        this.mensajeCiudad += "<br><br>";
        this.mensaje =
        this.mensajePais + this.mensajeProvincia + this.mensajeCiudad;
        console.log(this.mensaje);
        console.log(this.verMensaje);
        document.getElementById("mensaje").innerHTML = this.mensaje;
      }
    }
  }
}

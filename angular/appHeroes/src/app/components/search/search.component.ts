import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-search',
  templateUrl: './search.component.html',
  styles: [
  ]
})
export class SearchComponent implements OnInit {

  constructor( private activatedRoute: ActivatedRoute) { 

  }

 
  
  ngOnInit(): void {
    this.activatedRoute.params.subscribe( params => {
      console.log(params['termino']);
    })
  }

}

import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import {NgPipesModule} from 'ngx-pipes';
import { AppComponent } from './app.component';

@NgModule({
  declarations: [
    AppComponent
  ],
  imports: [
    BrowserModule,
    NgPipesModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }

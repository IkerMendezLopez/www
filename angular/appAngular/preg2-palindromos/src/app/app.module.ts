import { PalindromeService } from "./palindrome.service";
import { BrowserModule } from "@angular/platform-browser";
import { NgModule } from "@angular/core";
import { FormsModule } from "@angular/forms";

import { AppComponent } from "./app.component";
import { PalindromeFormComponent } from "./palindrome-form/palindrome-form.component";
import { PalindromeListComponent } from "./palindrome-list/palindrome-list.component";
import { PalindromeHeadingComponent } from "./palindrome-heading/palindrome-heading.component";

@NgModule({
  declarations: [
    AppComponent,
    PalindromeFormComponent,
    PalindromeListComponent,
    PalindromeHeadingComponent
  ],
  imports: [BrowserModule, FormsModule],
  providers: [PalindromeService],
  bootstrap: [AppComponent]
})
export class AppModule {}

import { Component, OnInit, OnDestroy } from "@angular/core";
import { Palindrome } from "../palindrome.model";
import { PalindromeService } from "./../palindrome.service";
import { Subscription } from "rxjs";

@Component({
  selector: "app-palindrome-list",
  templateUrl: "./palindrome-list.component.html",
  styleUrls: ["./palindrome-list.component.css"]
})
export class PalindromeListComponent implements OnInit, OnDestroy {
  palindromes: Palindrome[];
  private subscription: Subscription;

  constructor(private palindromeService: PalindromeService) {}

  ngOnInit() {
    this.palindromes = this.palindromeService.getPalindromes();
    this.subscription = this.palindromeService.palindromeFormChanged.subscribe(
      (palindromes: Palindrome[]) => {
        this.palindromes = palindromes;
      }
    );
  }

  ngOnDestroy() {
    this.subscription.unsubscribe();
  }
}

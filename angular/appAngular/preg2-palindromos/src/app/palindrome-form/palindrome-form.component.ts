import { Palindrome } from "./../palindrome.model";
import { PalindromeService } from "./../palindrome.service";
import { Component, OnInit, ViewChild, ElementRef } from "@angular/core";

@Component({
  selector: "app-palindrome-form",
  templateUrl: "./palindrome-form.component.html",
  styleUrls: ["./palindrome-form.component.css"]
})
export class PalindromeFormComponent implements OnInit {
  @ViewChild("palindromeInput") palindromeInputRef: ElementRef;
  @ViewChild("palindromeForm") pallindromeForm;

  constructor(private palindromeService: PalindromeService) {}

  ngOnInit() {}

  onAddPalindrome() {
    const palElement = this.palindromeInputRef;

    // replace() method removes the spaces from the input data
    const palElementValue = palElement.nativeElement.value.replace(/\s/g, "");
    const newPalindrome = new Palindrome(palElementValue);
    this.palindromeService.addPalindrome(newPalindrome);

    // Clear the input field after form submition
    this.pallindromeForm.resetForm();
  }
}

import { Palindrome } from "./palindrome.model";
import { Subject } from "rxjs";

export class PalindromeService {
  palindromeFormChanged = new Subject<Palindrome[]>();
  private palindromes: Palindrome[] = [
    new Palindrome("gag"),
    new Palindrome("mama"),
    new Palindrome("kayak")
  ];

  constructor() {}

  getPalindromes() {
    return this.palindromes.slice();
  }

  addPalindrome(palindrome: Palindrome) {
    // unshift añade los nuevos palíndromos a loa alto de la tabla
    this.palindromes.unshift(palindrome);
    this.palindromeFormChanged.next(this.palindromes.slice());
  }
}

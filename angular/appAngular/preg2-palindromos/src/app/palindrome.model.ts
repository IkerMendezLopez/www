export class Palindrome {
  public name: string;
  public length: number;
  public isPalindrome: boolean;

  constructor(name: string) {
    this.name = name;
    this.length = name.length;
    this.isPalindrome =
      name ===
      name
        .split("")
        .reverse()
        .join("");
  }
}

class Greeter {
    constructor(public greeting: string) { }
    greet() {
        return this.greeting;
    }
};
var greeter = new Greeter("Hello from typescript!");
console.log(greeter.greet());
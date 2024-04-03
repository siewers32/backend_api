// Create a class for the element
class MyCar extends HTMLElement {
    static observedAttributes = ["km"];
  
    constructor() {
      // Always call super first in constructor
      super();
      let template = document.getElementById("my-car");
      let templateContent = template.content;

      const shadowRoot = this.attachShadow({ mode: "open" });
      shadowRoot.appendChild(templateContent.cloneNode(true));
    }
  
    connectedCallback() {
      console.log("Custom element added to page.");
    }
  
    disconnectedCallback() {
      console.log("Custom element removed from page.");
    }
  
    adoptedCallback() {
      console.log("Custom element moved to new page.");
    }
  
    attributeChangedCallback(name, oldValue, newValue) {
      console.log(`Attribute ${name} has changed.`);
      updateStyle(this);
    }
  
  }
  
  function updateStyle(elem) {
    const car = elem.shadowRoot.getElementById("km");
    kmcolor = "yellow"
    if(elem.getAttribute("km") > 50000) {
      kmcolor = "red"
    }
    console.log(car)
    car.style.backgroundColor = kmcolor;
  }
  customElements.define("my-car", MyCar);

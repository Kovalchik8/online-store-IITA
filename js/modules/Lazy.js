class Lazy {
  constructor() {
    this.initLazy();
  }

  initLazy() {
    var myLazyLoad = new LazyLoad({
      elements_selector: ".lazy",
    });
  } 

}

export default Lazy;
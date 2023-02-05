window.addEventListener("scroll", function () {
  var top = this.document.querySelector(".top");
  if (this.window.scrollY > 0) {
    top.className = "sticky";
  }
});

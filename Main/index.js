const product = document.querySelectorAll(".productD");
console.log(product);

for (let i = 0; i < product.length; i++) {
  const stars = product[i].querySelector(".stars");
  const rating = Math.round(
    product[i].querySelector("input[type='hidden']").value
  );

  console.log(stars);
  console.log(rating);

  const spans = stars.querySelectorAll("span");
  for (let j = 0; j < rating; j++) {
    spans[j].classList.add("checked");
  }
}

window.addEventListener("scroll", function () {
  var header = this.document.querySelector("header");
  header.classList.toggle("sticky", this.window.scrollY > 0);
});

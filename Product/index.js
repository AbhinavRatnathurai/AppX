const stars = document.querySelectorAll(".stars");
const comment = document.querySelectorAll(".comment");
let length = stars.length;

for (let i = 0; i < length; i++) {
  let rating;
  const rate = comment[i].querySelector(".rate");
  //console.log(rate);

  rating = Math.round(rate.innerText);

  let star = stars[i].querySelectorAll("span");
  for (let j = 0; j < rating; j++) {
    star[j].classList.add("checked");
  }
}

window.addEventListener("scroll", function () {
  var header = this.document.querySelector("header");
  header.classList.toggle("sticky", this.window.scrollY > 0);
});

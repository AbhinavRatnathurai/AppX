function validateForm() {
  let comm = document.querySelector("#comment").value;
  if (comm === "") {
    alert("Write the comment befor submitting");
    document.querySelector("#comment").placeholder =
      "Write the comment befor sumitting";
    return false;
  }
}

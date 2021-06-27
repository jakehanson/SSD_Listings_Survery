function myFunction() {

  var x = document.getElementById("myDIV");
  console.log(x);
  if (x.style.display === "none") {
    alert("I AM HERE");
    x.style.display = "block";
  } else {
    alert("I AM NOT HERE");

    x.style.display = "none";
  }

}
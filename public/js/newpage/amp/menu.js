document.getElementById("btn-menu").addEventListener("click", function(){
    var x = document.getElementById("menu-header-amp");
    if (x.style.display === "block") {
      x.style.display = "none";
    } else {
      x.style.display = "block";
    }
  });

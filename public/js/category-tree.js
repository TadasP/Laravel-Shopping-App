var toggler = document.getElementsByClassName("customcaret");
var i;

for (i = 0; i < toggler.length; i++) {
  toggler[0].addEventListener('click', function(){
    this.parentElement.querySelector(".nested").classList.toggle("active");
    this.classList.toggle("caret-down");
  }, false);
} 
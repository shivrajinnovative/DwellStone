
window.onscroll = function() {
    var navbar = document.querySelector(".navbar");
    var scrollThreshold = window.innerWidth < 500 ? 80 : 100;

    if (window.pageYOffset >= scrollThreshold) {
        navbar.style.position = "fixed";
      
        navbar.style.top = 0;

    } else {
        navbar.style.position = "absolute";
        navbar.style.top = 0;
    }
};


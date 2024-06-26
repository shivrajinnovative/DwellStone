window.onscroll = function() {
    var navbar = document.querySelector(".navbar");
    var scrollThreshold = window.innerWidth < 500 ? 80 : 100;
    var leftMove = window.innerWidth < 500 ? '0' : '5%';
    var topMove = window.innerWidth < 500 ? '90px' : '120px';

    if (window.pageYOffset >= scrollThreshold) {
        navbar.style.position = "fixed";
        navbar.style.top = "0"; 
        navbar.style.left = leftMove; 
    } else {
        navbar.style.position = "absolute";
        navbar.style.top = topMove;
    }
};
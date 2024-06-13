window.addEventListener('scroll', function() {
    var nav = document.querySelector('nav'); // Sélectionnez l'élément nav
    if (window.pageYOffset > 0) {
        nav.classList.remove('downFalse');
        nav.classList.add('downTrue');
    } else {
        nav.classList.remove('downTrue');
        nav.classList.add('downFlase');
    }
});
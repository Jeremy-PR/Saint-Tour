document.addEventListener('DOMContentLoaded', () => {
    // Gestion du menu burger
    const menuToggle = document.getElementById('menu-toggle');
    const menu = document.getElementById('menu');

    if (menuToggle && menu) {
        menuToggle.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    }

    // Gestion du footer - colonne gauche
    const footerToggleLeft = document.getElementById('footer-toggle-left');
    const footerMenuLeft = document.getElementById('footer-menu-left');
    const footerArrowLeft = document.getElementById('footer-arrow-left');

    if (footerToggleLeft && footerMenuLeft && footerArrowLeft) {
        footerToggleLeft.addEventListener('click', () => {
            footerMenuLeft.classList.toggle('hidden');
            footerArrowLeft.classList.toggle('fa-chevron-down');
            footerArrowLeft.classList.toggle('fa-chevron-up');
        });
    }

    // Gestion du footer - colonne droite
    const footerToggleRight = document.getElementById('footer-toggle-right');
    const footerMenuRight = document.getElementById('footer-menu-right');
    const footerArrowRight = document.getElementById('footer-arrow-right');

    if (footerToggleRight && footerMenuRight && footerArrowRight) {
        footerToggleRight.addEventListener('click', () => {
            footerMenuRight.classList.toggle('hidden');
            footerArrowRight.classList.toggle('fa-chevron-down');
            footerArrowRight.classList.toggle('fa-chevron-up');
        });
    }
});
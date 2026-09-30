(() => {
    const navbar = document.querySelector('.navbar');
    const menuIcon = document.querySelector('#menu-icon i');

    window.addEventListener('scroll', () => {
        if (navbar) navbar.classList.remove('active');
        if (menuIcon) {
            menuIcon.classList.remove('bx-x');
            menuIcon.classList.add('bx-menu');
        }
    });

    const multipleText = document.querySelector('.multiple-text');
    if (multipleText && typeof Typed !== 'undefined') {
        const typed = new Typed(multipleText, {
            strings: [
                multipleText.textContent.trim(),
                'Frontend Developer',
                'Backend Developer',
                'Blockchain Developer',
                'Web Designer',
                'Youtuber'
            ].filter(Boolean),
            typeSpeed: 80,
            backSpeed: 80,
            backDelay: 1200,
            loop: true
        });
    }
})();
function hover() {
    const works = document.getElementsByClassName('img-grid');
    for (let work of works) {
        const img = work.firstElementChild.firstElementChild;
        const text = img.nextElementSibling;
        work.addEventListener('mouseenter', () => {
            img.style.opacity = 0.2;
            text.style.opacity = 1;
        });
        work.addEventListener('mouseleave', () => {
            img.style.opacity = 1;
            text.style.opacity = 0;
        });
    }
}

window.addEventListener('load', hover);

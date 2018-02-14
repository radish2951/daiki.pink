document.body.style.overflow = 'hidden';
document.getElementsByClassName('content')[0].classList.add('hide');
window.addEventListener('load', () => {
    document.body.style.overflow = 'initial';
    document.getElementsByClassName('content')[0].classList.add('show');
});

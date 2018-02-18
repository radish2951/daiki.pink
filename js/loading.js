const fadeTime = 400;
const message = '';

const overlay = document.createElement('div');
const header = document.body.firstElementChild;
const style = document.createElement('style');
style.innerHTML = `
    #overlay {
        opacity: 1;
        transition: opacity ${fadeTime}ms;
    }
    #overlay.hide {
        opacity: 0;
    }
`;
document.body.insertBefore(overlay, header);
document.body.insertBefore(style, header);
overlay.id = 'overlay';
overlay.style.width = '100vw';
overlay.style.height = '100vh';
overlay.style.background = 'white';
overlay.style.display = 'flex';
overlay.style.position = 'fixed';
overlay.style.top = 0;
overlay.style.color = 'black';
overlay.style.fontSize = '10px';
overlay.style.zIndex = 1000;
overlay.style.justifyContent = 'center';
overlay.style.alignItems = 'center';
overlay.textContent = message;
document.body.style.overflow = 'hidden';
window.addEventListener('load', () => {
    overlay.classList.add('hide');
    document.body.style.overflow = 'visible';
    setTimeout(() => {
        overlay.style.display = 'none';
    }, fadeTime);
});

const showImg = () => {
    const imgsInsideLinks = [];
    const links = document.getElementsByTagName('a');
    for (const link of links) {
        const imgsInsideLink = link.getElementsByTagName('img');
        for (const imgInsideLink of imgsInsideLink) {
            imgsInsideLinks.push(imgInsideLink);
        }
    }
    console.log(imgsInsideLinks);
    const imgs = document.getElementsByTagName('img');
    for (let i = 0; i < imgs.length; i++) {
        if (imgsInsideLinks.indexOf(imgs[i]) >= 0) {
            imgs[i] = '';
        }
    }
    console.log(imgs);
    for (img of imgs) {
        img.addEventListener('click', (e) => {
            const overlay = document.createElement('div');
            overlay.id = 'overlay';
            overlay.style.position = 'fixed';
            overlay.style.top = 0;
            overlay.style.left = 0;
            overlay.style.width = '100%';
            overlay.style.height = '100vh';
            overlay.style.background = 'rgba(255, 255, 255, 0.9)';
            overlay.style.backgroundImage = `url(${e.target.getAttribute('src')})`;
            overlay.style.backgroundSize = 'contain';
            overlay.style.backgroundPosition = 'center';
            overlay.style.backgroundRepeat = 'no-repeat';
            document.body.style.overflow = 'hidden';
            document.body.style.height = '100vh';
            document.body.appendChild(overlay);

            overlay.addEventListener('click', (e) => {
                e.target.remove();
                document.body.style.overflow = 'initial';
                document.body.style.height = 'initial';
            });
        });
    }
};

document.addEventListener('DOMContentLoaded', () => {
    showImg();
});

const showImg = () => {

    const imgsInsideLinks = [];
    const imgsWithoutLinks = [];
    const links = document.getElementsByTagName('a');
    const imgs = document.getElementsByTagName('img');

    for (const link of links) {
        const imgsInsideLink = link.getElementsByTagName('img');
        for (const imgInsideLink of imgsInsideLink) {
            imgsInsideLinks.push(imgInsideLink);
        }
    }
    for (const img of imgs) {
        if (!imgsInsideLinks.includes(img)) {
            imgsWithoutLinks.push(img);
        }
    }

    const style = document.createElement('style');
    style.innerHTML = `
        #img-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background: rgba(0, 0, 0, 0.8);
            background-size: contain;
            background-position: center;
            background-repeat: no-repeat;
            opacity: 0;
            transition: opacity 200ms;
        }
        #img-overlay.show {
            opacity: 1;
        }
    `;
    document.body.appendChild(style);

    for (const img of imgsWithoutLinks) {
        img.addEventListener('click', (e) => {

            const overlay = document.createElement('div');
            overlay.id = 'img-overlay';
            overlay.style.backgroundImage = `url(${e.target.getAttribute('src')})`;
            document.body.style.overflow = 'hidden';
            document.body.style.height = '100vh';
            document.body.appendChild(overlay);

            setTimeout(() => {
                overlay.classList.toggle('show');
            }, 5);

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

const content = document.getElementsByClassName('content')[0];
const imgs = content.getElementsByTagName('img');

for (const img of imgs) {
    const w = img.getAttribute('width') * 1;
    const h = img.getAttribute('height') * 1;
    if (w < h) {
        img.style.width = (w / h) * 100 + '%';
    }
}


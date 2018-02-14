const photoGrid = () => {

    const w = document.getElementById('content-photo').clientWidth;

    const numPhotoRow = 2;                                            
    const photoMargin = 3;
    const photoWidth = (w - photoMargin * (numPhotoRow + 1)) / numPhotoRow;

    const heights = [];
    const rowHeights = [];
    const diffs = [];

    const photos = document.getElementsByClassName('photo-grid');
    const numPhoto = photos.length;

    for (let i = 0; i < numPhoto; i++) {
        photos[i].style.width = photoWidth + 'px';    
        photos[i].style.margin = 0;
        photos[i].style.marginLeft = photoMargin + 'px';
        photos[i].style.marginBottom = photoMargin + 'px';
        heights[i] = parseInt(photos[i].clientHeight);
    }

    for (let i = 0; i < numPhotoRow; i++) {
        rowHeights[i] = 0;
        diffs[i] = 0;
    }
    
    for (let i = 0; i < parseInt(numPhoto/numPhotoRow); i++) {
        const maxHeight = Math.max(...heights.slice(i*numPhotoRow, (i+1)*numPhotoRow));
        for (let j = 0; j < numPhotoRow; j++) {
            const diff = maxHeight - heights[i * numPhotoRow + j];
            diffs[j] += diff;
            photos[i * numPhotoRow + j].style.top = (-diffs[j]) + 'px';
            rowHeights[j] += heights[i * numPhotoRow + j] + photoMargin;
        }
    }

    const r = numPhoto % numPhotoRow

    if (r > 0) {
        const maxHeight = Math.max(...heights.slice(numPhoto-r, numPhoto));
        for (let j = 0; j < r; j++) {
            const index = numPhoto - r + j;
            const diff = maxHeight - heights[index];
            diffs[j] += diff;
            photos[index].style.top = (-diffs[j]) + 'px';
            rowHeights[j] += heights[index] + photoMargin;
        }        
    }

    const contentPhoto = document.getElementById('content-photo');

    contentPhoto.style.overflow = 'hidden';
    contentPhoto.style.height = (Math.max(...rowHeights)) + 'px';

};



if (!navigator.userAgent.match(/(iPhone|iPod|Android)/)) {
    window.addEventListener("load", photoGrid);
    window.addEventListener("resize", photoGrid);
}

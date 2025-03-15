
// step 1: get DOM
let nextDom = document.getElementById('next');
let prevDom = document.getElementById('prev');

let carouselDom = document.querySelector('.carousel');
let SliderDom = carouselDom.querySelector('.list');
let thumbnailBorderDom = document.querySelector('.carousel .thumbnail');
let thumbnailItemsDom = thumbnailBorderDom.querySelectorAll('.item');
let timeDom = document.querySelector('.carousel .time');

thumbnailBorderDom.appendChild(thumbnailItemsDom[0]);

let timeRunning = 3000;
let timeAutoNext = 5000;

nextDom.onclick = function () {
    showSlider('next');
}

prevDom.onclick = function () {
    showSlider('prev');
}

let runTimeOut;
let runNextAuto = setTimeout(() => {
    nextDom.click();
}, timeAutoNext);

function showSlider(type) {
    let SliderItemsDom = SliderDom.querySelectorAll('.item');
    let thumbnailItemsDom = document.querySelectorAll('.carousel .thumbnail .item');

    if (type === 'next') {
        SliderDom.appendChild(SliderItemsDom[0]);
        thumbnailBorderDom.appendChild(thumbnailItemsDom[0]);
        carouselDom.classList.add('next');
    } else if (type === 'prev') {
        SliderDom.prepend(SliderItemsDom[SliderItemsDom.length - 1]);
        thumbnailBorderDom.prepend(thumbnailItemsDom[thumbnailItemsDom.length - 1]);
        carouselDom.classList.add('prev');
    }

    clearTimeout(runTimeOut);
    runTimeOut = setTimeout(() => {
        carouselDom.classList.remove('next');
        carouselDom.classList.remove('prev');
    }, timeRunning);

    clearTimeout(runNextAuto);
    runNextAuto = setTimeout(() => {
        nextDom.click();
    }, timeAutoNext);
}

// Function to move to a specific slide based on index
function goToSlide(index) {
    let SliderItemsDom = Array.from(SliderDom.querySelectorAll('.item'));
    let currentItem = SliderItemsDom[0];  // First item in the current slider

    // If the clicked thumbnail is already in the current slide, do nothing
    if (SliderItemsDom[index] === currentItem) {
        return;
    }

    // Shift slides until the selected one is at the front
    let steps = index - Array.from(SliderItemsDom).indexOf(currentItem);
    if (steps > 0) {
        for (let i = 0; i < steps; i++) {
            SliderDom.appendChild(SliderItemsDom[0]);
            thumbnailBorderDom.appendChild(thumbnailItemsDom[0]);
        }
    } else {
        for (let i = 0; i < Math.abs(steps); i++) {
            SliderDom.prepend(SliderItemsDom[SliderItemsDom.length - 1]);
            thumbnailBorderDom.prepend(thumbnailItemsDom[thumbnailItemsDom.length - 1]);
        }
    }
}

// Add click event for each thumbnail item
thumbnailItemsDom.forEach((item, index) => {
    item.addEventListener('click', () => {
        goToSlide(index);  // Go to the slide corresponding to the clicked thumbnail
        clearTimeout(runNextAuto);  // Stop auto-play when user interacts
        runNextAuto = setTimeout(() => {
            nextDom.click();  // Resume auto-play after a while
        }, timeAutoNext);
    });
});
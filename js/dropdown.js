let dropDown = document.querySelector('.dropdown-menu');
let dropDownBtn = document.querySelector('.nav-dropdown-btn');
dropDownBtn.addEventListener('click', () => {
    dropDown.classList.toggle('open');
    let opned = dropDown.classList.contains('open');
    if (!opned) {
        dropDownBtn.classList = 'bi bi-list nav-dropdown-btn';
    } else {
        dropDownBtn.classList = 'bi bi-x nav-dropdown-btn';
    }
});

function toggleDropdown() {
    const container = document.querySelector('.avatar-container');
    container.classList.toggle('active');
}

document.addEventListener('click', function(event) {
    const container = document.querySelector('.avatar-container');
    if (!container.contains(event.target)) {
        container.classList.remove('active');
    }
});
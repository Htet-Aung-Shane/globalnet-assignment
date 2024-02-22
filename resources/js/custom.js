// custom.js
document.addEventListener('DOMContentLoaded', function() {
    const closeButton = document.getElementById('closeButton');
    const alertBox = document.getElementById('alertBox');

    closeButton.addEventListener('click', function() {
        alertBox.style.display = 'none';
    });
});

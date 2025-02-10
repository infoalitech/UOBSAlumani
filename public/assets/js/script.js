document.addEventListener("DOMContentLoaded", function() {
    console.log("JavaScript Loaded");
    
    let menuToggle = document.getElementById("menu-toggle");
    if (menuToggle) {
        menuToggle.addEventListener("click", function() {
            let menu = document.getElementById("menu");
            if (menu) {
                menu.classList.toggle("show");
            }
        });
    }
});

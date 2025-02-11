document.addEventListener('DOMContentLoaded', function() {
    // Example of a simple alert on page load
    alert('Welcome to the PHP CRUD App!');

    // Function to handle form submissions
    const handleFormSubmit = (formId) => {
        const form = document.getElementById(formId);
        if (form) {
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                // Perform AJAX request or form submission logic here
                alert('Form submitted: ' + formId);
            });
        }
    };

    // Initialize form handlers
    handleFormSubmit('loginForm');
    handleFormSubmit('registerForm');
});
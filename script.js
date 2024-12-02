document.querySelector('form').addEventListener('submit', function(event) {
    event.preventDefault();  // Prevent default form submission

    const formData = new FormData(this);

    fetch('process_form.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        const formMessage = document.getElementById('form-message');
        
        if (data.status === 'error') {
            // Handle errors
            formMessage.innerHTML = '<div class="alert alert-danger">There were errors in your form submission. Please check your inputs.</div>';
            
            // Optionally display field-specific errors here
            for (let field in data.errors) {
                const errorMsg = data.errors[field];
                const inputField = document.querySelector(`[name="${field}"]`);
                const errorDiv = document.createElement('div');
                errorDiv.classList.add('error-message');
                errorDiv.textContent = errorMsg;
                inputField.closest('.col-md-6').appendChild(errorDiv);
            }
        } else {
            // Handle success
            formMessage.innerHTML = '<div class="alert alert-success">Form submitted successfully! Redirecting...</div>';

            // Clear the form
            this.reset();

            // Redirect after 5 seconds
            setTimeout(function() {
                window.location.href = 'index.html'; // Replace with the actual home page URL
            }, 5000);
        }
    })
    .catch(error => {
        console.error('Error submitting form:', error);
    });
});

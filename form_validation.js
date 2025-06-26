document.addEventListener('DOMContentLoaded', function() {
    // Get the form element
    const applyForm = document.getElementById('applyForm');
    
    if (applyForm) {
        // Add form submission handler
        applyForm.addEventListener('submit', function(event) {
            // Prevent default form submission
            event.preventDefault();
            
            // Validate form
            if (validateForm()) {
                // Show loading indicator
                showLoadingIndicator();
                
                // Submit form using AJAX
                submitFormAjax();
            }
        });
    }
    // Form validation function
    function validateForm() {
        let isValid = true;
        
        // Get form fields
        const fullname = document.getElementById('fullname');
        const email = document.getElementById('email');
        const phone = document.getElementById('phone');
        const level = document.getElementById('level');
        const documents = document.getElementById('documents');
        
        // Reset previous error states
        resetErrors();
        
        // Validate fullname
        if (fullname.value.trim() === '') {
            showError(fullname, 'Full name is required');
            isValid = false;
        }
        
        // Validate email
        if (email.value.trim() === '') {
            showError(email, 'Email is required');
            isValid = false;
        } else if (!isValidEmail(email.value)) {
            showError(email, 'Please enter a valid email address');
            isValid = false;
        }
        
        // Validate phone
        if (phone.value.trim() === '') {
            showError(phone, 'Phone number is required');
            isValid = false;
        }
        
        // Validate level selection
        if (level.value === '') {
            showError(level, 'Please select a level');
            isValid = false;
        }
        
        // Validate documents
        if (documents.files.length === 0) {
            showError(documents, 'Please upload at least one document');
            isValid = false;
        } else {
            // Check file types and sizes
            const maxFileSize = 5 * 1024 * 1024; // 5MB
            const allowedTypes = ['application/pdf', 'image/jpeg', 'image/jpg', 'image/png', 'application/zip'];
            
            for (let i = 0; i < documents.files.length; i++) {
                const file = documents.files[i];
                
                // Check file size
                if (file.size > maxFileSize) {
                    showError(documents, `File ${file.name} is too large. Maximum size is 5MB.`);
                    isValid = false;
                    break;
                }
                
                // Check file type by extension as browser might not always provide the correct MIME type
                const fileExt = file.name.split('.').pop().toLowerCase();
                if (!['pdf', 'jpg', 'jpeg', 'png', 'zip'].includes(fileExt)) {
                    showError(documents, `File ${file.name} is not an allowed file type. Please use PDF, JPG, PNG, or ZIP files.`);
                    isValid = false;
                    break;
                }
            }
        }
        
        return isValid;
    }
    
    // Email validation function
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
    
    // Display error message
    function showError(inputElement, message) {
        // Create error element if it doesn't exist
        let errorElement = inputElement.nextElementSibling;
        if (!errorElement || !errorElement.classList.contains('error-message')) {
            errorElement = document.createElement('div');
            errorElement.className = 'error-message';
            errorElement.style.color = 'red';
            errorElement.style.fontSize = '14px';
            errorElement.style.marginTop = '5px';
            inputElement.parentNode.insertBefore(errorElement, inputElement.nextElementSibling);
        }
        
        // Set error message
        errorElement.textContent = message;
        
        // Highlight input
        inputElement.style.borderColor = 'red';
    }
    
    // Reset all error messages
    function resetErrors() {
        // Remove all error messages
        const errorMessages = document.querySelectorAll('.error-message');
        errorMessages.forEach(function(errorMsg) {
            errorMsg.remove();
        });
        
        // Reset input borders
        const formInputs = applyForm.querySelectorAll('input, select, textarea');
        formInputs.forEach(function(input) {
            input.style.borderColor = '';
        });
    }
    
    // Show loading indicator
    function showLoadingIndicator() {
        // Create loading element
        const loadingElement = document.createElement('div');
        loadingElement.id = 'form-loading';
        loadingElement.innerHTML = 'Submitting application...';
        loadingElement.style.padding = '10px';
        loadingElement.style.backgroundColor = '#f0f0f0';
        loadingElement.style.textAlign = 'center';
        loadingElement.style.marginTop = '10px';
        
        // Add loading element after the form
        applyForm.parentNode.insertBefore(loadingElement, applyForm.nextSibling);
        
        // Disable submit button
        const submitButton = applyForm.querySelector('button[type="submit"]');
        submitButton.disabled = true;
        submitButton.textContent = 'Submitting...';
    }
    
    // Hide loading indicator
    function hideLoadingIndicator() {
        const loadingElement = document.getElementById('form-loading');
        if (loadingElement) {
            loadingElement.remove();
        }
        
        // Enable submit button
        const submitButton = applyForm.querySelector('button[type="submit"]');
        submitButton.disabled = false;
        submitButton.textContent = 'Submit Application';
    }
    
    // Submit form using AJAX
    function submitFormAjax() {
        const formData = new FormData(applyForm);
        
        fetch('submit-application.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            // Hide loading indicator
            hideLoadingIndicator();
            
            if (data.status === 'success') {
                // Show success message
                showMessage('success', data.message);
                
                // Reset form
                applyForm.reset();
            } else {
                // Show error message
                showMessage('error', data.message);
            }
        })
        .catch(error => {
            // Hide loading indicator
            hideLoadingIndicator();
            
            // Show error message
            showMessage('error', 'An error occurred while submitting your application. Please try again later.');
            console.error('Error:', error);
        });
    }
    
    // Show status message
    function showMessage(type, message) {
        // Remove any existing message
        const existingMessage = document.getElementById('form-message');
        if (existingMessage) {
            existingMessage.remove();
        }
        
        // Create message element
        const messageElement = document.createElement('div');
        messageElement.id = 'form-message';
        messageElement.textContent = message;
        messageElement.style.padding = '15px';
        messageElement.style.marginTop = '20px';
        messageElement.style.borderRadius = '4px';
        
        if (type === 'success') {
            messageElement.style.backgroundColor = '#d4edda';
            messageElement.style.color = '#155724';
            messageElement.style.border = '1px solid #c3e6cb';
        } else {
            messageElement.style.backgroundColor = '#f8d7da';
            messageElement.style.color = '#721c24';
            messageElement.style.border = '1px solid #f5c6cb';
        }
        
        // Add message after the form
        applyForm.parentNode.insertBefore(messageElement, applyForm.nextSibling);
        
        // Scroll to message
        messageElement.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        
        // Auto-remove success message after 5 seconds
        if (type === 'success') {
            setTimeout(function() {
                messageElement.remove();
            }, 5000);
        }
    }
});
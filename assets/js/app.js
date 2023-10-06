const successMessage = document.querySelector('#success-message');
const errorMessage = document.querySelector('#error-message');

if (successMessage) {
    setTimeout(() => {
        successMessage.style.display = 'none';
    }, 6000);
}
if (errorMessage) {
    setTimeout(() => {
        errorMessage.style.display = 'none';
    }, 6000);
}






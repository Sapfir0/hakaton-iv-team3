

function showError(element, errorString) {
    element.innerHTML = errorString;
    element.className = 'error'
}

function hideError(element) {
    element.innerHTML = "";
    element.className = 'clear'
}

export {showError, hideError}
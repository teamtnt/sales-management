function openModal(name, modalData = null) {
    let data = {
        name: name,
        data: modalData
    };
    EventBus.$emit('open-modal', data);
}

function redirect(url) {
    if (url === null || typeof url === 'undefined') {
        url = '';
    }
    if (url.trim().length < 1) {
        return;
    }

    window.location.href = url;
}

function csrfToken() {
    return window.App.config.csrfToken;
}

window.openModal = openModal;
window.redirect = redirect;
window.csrfToken = csrfToken;

export default {
    openModal,
    csrfToken,
}
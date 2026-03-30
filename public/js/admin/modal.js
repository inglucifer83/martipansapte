let modal = null;
let form = null;
let options = {};

function submitForm() {
    if (form) {
        form.submit();
    }
}

function alertModalConfirmButtonClicked(e) {
    if (form) {
        submitForm();
    }

    if (options.onConfirm && typeof options.onConfirm === 'function') {
        options.onConfirm(e);
    }

    if (modal) {
        modal.dispose();
        modal = null;
        form = null;
        options = {};
    }
}

function alertModalCancelButtonClicked(e) {
    if (options.onCancel && typeof options.onCancel === 'function') {
        options.onCancel(e);
    }

    form = null;
    options = {};
}

function alertModalCloseButtonClicked(e) {
    if (options.onClose && typeof options.onClose === 'function') {
        options.onClose(e);
    }
}

function showModal(o) {
    const body = document.getElementById('admin-alert-modal-body');
    const title = document.getElementById('admin-alert-modal-title');
    const confirmButton = document.getElementById('admin-alert-modal-confirm-button');
    const cancelButton = document.getElementById('admin-alert-modal-cancel-button');
    const closeButton = document.getElementById('admin-alert-modal-close-button');

    options = JSON.parse(JSON.stringify(o));

    confirmButton.removeEventListener('click', alertModalConfirmButtonClicked);
    confirmButton.addEventListener('click', alertModalConfirmButtonClicked);
    cancelButton.removeEventListener('click', alertModalCancelButtonClicked);
    cancelButton.addEventListener('click', alertModalCancelButtonClicked);
    closeButton.removeEventListener('click', alertModalCloseButtonClicked);
    closeButton.addEventListener('click', alertModalCloseButtonClicked);

    title.textContent = options.title;
    body.textContent = options.body;
    confirmButton.classList.add(`btn-${options.type ? options.type : 'primary'}`);
    confirmButton.textContent = options.confirm ?? 'Yes';
    cancelButton.textContent = options.cancel ?? 'Cancel';

    modal = bootstrap.Modal.getOrCreateInstance('#admin-alert-modal').show();
}

(function() {
    const buttons = document.querySelectorAll('[data-modal]');
    for (let i = 0; i < buttons.length; i += 1) {
        const element = buttons[i];


        element.addEventListener('click', function(e) {
            const button = e.target;
            const scope = button.dataset.modal;
            if (scope == 'form') {
                form = button.parentNode;
            }

            const title = button.dataset.title ?? '';
            const body = button.dataset.body ?? '';
            const type = button.dataset.type ?? 'primary';
            const confirm = button.dataset.confirm ?? 'Yes';
            const cancel = button.dataset.cancel ?? 'Cancel';

            showModal({title, body, type, confirm, cancel});
        });
    }
})();

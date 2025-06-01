//Thông báo lỗi hoặc thành công
function showPopup(message) {
    const popup = document.getElementById('notificationPopup');
    const messageBox = document.getElementById('notificationMessage');

    if (popup && messageBox) {
        messageBox.innerHTML = message;
        popup.classList.remove('hidden');

        // Tự động đóng sau 2 giây
        setTimeout(() => {
            closePopup();
        }, 10000);
    }
}

function closePopup() {
    const popup = document.getElementById('notificationPopup');
    if (popup) {
        popup.classList.add('hidden');
    }
}

window.addEventListener('DOMContentLoaded', () => {
    const success = document.body.dataset.success;
    const error = document.body.dataset.error;

    if (success) showPopup(success);
    else if (error) showPopup(error);
});


//Thông báo Xóa
function openPopupDelete(message) {
    document.getElementById('Message').innerText = message;
    document.getElementById('PopupDelete').classList.remove('hidden');
}

function closePopupDelete() {
    document.getElementById('PopupDelete').classList.add('hidden');
}
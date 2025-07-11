import Inputmask from "inputmask";

document.addEventListener('DOMContentLoaded', () => {
    const phoneInput = document.querySelector('input[name="phone"]');

    if (phoneInput) {
        Inputmask({"mask": "(99) 9999-9999"}).mask(phoneInput);
    }
});
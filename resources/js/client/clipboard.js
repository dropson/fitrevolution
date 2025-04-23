
import ClipboardJS from 'clipboard';

document.addEventListener('DOMContentLoaded', () => {

    const clipboardButtons = document.querySelectorAll('.js-clipboard');


    const clipboard = new ClipboardJS(clipboardButtons);


    clipboard.on('success', function(e) {
        const button = e.trigger; 
        const defaultIcon = button.querySelector('.js-clipboard-default');
        const successIcon = button.querySelector('.js-clipboard-success');
        const successText = button.querySelector('.js-clipboard-success-text');
        const successMessage = button.getAttribute('data-clipboard-success-text') || 'Copied!';


        defaultIcon.classList.add('hidden');
        successIcon.classList.remove('hidden');
        successText.textContent = successMessage;


        setTimeout(() => {
            defaultIcon.classList.remove('hidden');
            successIcon.classList.add('hidden');
            successText.textContent = 'Copy';
        }, 2000);

        e.clearSelection();
    });


    clipboard.on('error', function(e) {
        const button = e.trigger;
        const textToCopy = button.getAttribute('data-clipboard-text') || document.querySelector(button.getAttribute('data-clipboard-target')).value;

        console.error('Error of coppy: ', e);
       
    });
});
// const BUTTON_CLICK_EVENT= document.getElementById('liked');
// BUTTON_CLICK_EVENT.addEventListener('click', () => {
//     alert("ボタンがクリックされました");
// });

document.addEventListener('DOMContentLoaded', function() {
    const element = document.getElementById('liked');
    if (element) {
        element.addEventListener('click', function() {
            console.log('Element clicked');
        });
    } else {
        console.error('Element with ID example not found');
    }
});
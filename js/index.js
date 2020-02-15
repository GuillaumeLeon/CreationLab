const zoneText = document.getElementById('content_com');
const send_button = document.getElementById('send_but');
const replies = document.getElementsByClassName('replies');

function comment() {
    zoneText.style.display = 'block';
    send_button.style.display = 'block';
    replies.style.display = 'none';
}

function upvote(id) {
    let xhr = new XMLHttpRequest();
    xhr.open('POST', '../vote.php');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function(){
        if(xhr.status === 200){
        } else if(xhr.status !== 200){
        }
    };
    xhr.send("voteType=upvote&post_id="+id);
    id = String(id);
    const vote = document.getElementById(id);
    vote.style.color = "green";
}
function downvote(id) {
    let xhr = new XMLHttpRequest();
    xhr.open('POST', '../vote.php');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function(){
        if(xhr.status === 200) {
        } else if(xhr.status !== 200) {
        }
    };
    xhr.send("voteType=downvote&post_id="+id);
    const vote = document.getElementById(id);
    vote.style.color = "red";
}

const button = document.getElementById('back2Top');
window.addEventListener('scroll', function(e){
    if(window.scrollY > 300) {
        button.style.display = 'block';
    } else {
        button.style.display = 'none';
    }
});

// Fonction Ajax pour mettre un upvote
function upvote(id) {
  let xhr = new XMLHttpRequest();
  xhr.open('POST', '../app/vote.php');
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

// Fonction Ajax pour mettre un downvote
function downvote(id) {
  let xhr = new XMLHttpRequest();
  xhr.open('POST', '../app/vote.php');
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

function favoris(id) {
  let xhr = new XMLHttpRequest();
  xhr.open('POST', '../app/favoris.php');
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onload = function(){
    if(xhr.status === 200) {
    } else if(xhr.status !== 200) {
    }
  };
  xhr.send("post_id="+id);
}

// Bouton de retour en haut
const button = document.getElementById('back2Top');
window.addEventListener('scroll', function(e){
  if(window.innerWidth > 1024) {
    if(window.scrollY > 300) {
      button.style.display = 'block';
    } else {
      button.style.display = 'none';
    }
  }
});

// Désactive les tooltips sur les écrans tactile
if(!('ontouchstart' in window))
{
  $('.tooltip').tooltip(options);
}

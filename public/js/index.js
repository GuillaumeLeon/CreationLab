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
    console.log(id)
  const upvote = document.getElementsByClassName('btn '+id+' upvote');
  const downvote = document.getElementsByClassName('btn '+id+' downvote');
  const nb_vote = document.getElementsByClassName('numberVote '+id);

  if(upvote[0].style.color == 'green') {
    nb_vote[0].innerHTML = (parseInt(nb_vote[0].innerHTML) - 1);
    upvote[0].style.color = "#212529";
  } else if(downvote[0].style.color == 'red') {
    nb_vote[0].innerHTML = (parseInt(nb_vote[0].innerHTML) + 2);
    upvote[0].style.color = 'green';
  } else {
    nb_vote[0].innerHTML = (parseInt(nb_vote[0].innerHTML) + 1);
    upvote[0].style.color = "green";
  }
  downvote[0].style.color = "#212529";
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
  const downvote = document.getElementsByClassName('btn '+id+' downvote');
  const upvote = document.getElementsByClassName('btn '+id+' upvote');
  const nb_vote = document.getElementsByClassName('numberVote '+id);

  if(downvote[0].style.color == 'red') {
    nb_vote[0].innerHTML = (parseInt(nb_vote[0].innerHTML) + 1);
    downvote[0].style.color = "#212529";
  } else if(upvote[0].style.color == 'green') {
    nb_vote[0].innerHTML = (parseInt(nb_vote[0].innerHTML) - 2);
    downvote[0].style.color = "red";
  } else {
    nb_vote[0].innerHTML = (parseInt(nb_vote[0].innerHTML) - 1);
    downvote[0].style.color = "red";
  }
  upvote[0].style.color = "#212529";

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
  const fav = document.getElementsByClassName('fav_btn '+id);
    console.log(fav[0].childNodes)
  if(fav[0].childNodes[0].className == 'far fa-bookmark') {
    fav[0].childNodes[0].className = 'fas fa-bookmark'
  } else if (fav[0].childNodes[0].className == 'fas fa-bookmark') {
    fav[0].childNodes[0].className = 'far fa-bookmark'
  }

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
  const tooltip = document.getElementsByClassName('tooltip');
  tooltip.disabled = 'true';
}

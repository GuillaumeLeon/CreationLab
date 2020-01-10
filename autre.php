<?php
require('db.php');

session_start();
var_dump($_SESSION['connected']);
if($_SESSION['connected'] != 1) {
   header('Location:index.php');
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="image/favicon.ico" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <title>Creation Lab</title>
    <style type="text/css">
        .ajax-load{
            background: #e1e1e1;
            padding: 10px 0px;
            width: 100%;
        }
    </style>
</head>

<body>
<nav class="navbar">
    <span class="logo"><a href="index.php"><img src="image/Creation_Lab.png" alt="logo_creationLab" width="149"
						height="71"></a></span>
    <span><a href="deco.php"><button>Déconnexion</button></a></span>
</nav>
<div class="post-data">
<?php
$get_post = $db->prepare('SELECT * FROM post_text');
$get_post->execute();

?>
<?php include('data.php'); ?>
</div>

<div class="ajax-load text-center" style="display:none">
    <p><img src="http://demo.itsolutionstuff.com/plugin/loader.gif">Loading More post</p>
</div>
<script type="text/javascript">
$(window).scroll(function() {

   if($(window).scrollTop() + $(window).height() >= $(document).height()) {

      var last_id = $(".post-id:last").attr("id");

      loadMoreData(last_id);

	}

    });
    function loadMoreData(last_id){
       $.ajax(
    {

       url: '/loadMoreData.php?last_id=' + last_id,

	  type: "get",

	  beforeSend: function()

	  {

	     $('.ajax-load').show();

		}

	    })

	    .done(function(data)

	    {

	       $('.ajax-load').hide();

	       $("#post-data").append(data);

	    })
	    .fail(function(jqXHR, ajaxOptions, thrownError)
	    {
	       alert('server not responding...');
	    });
    }

</script>
</body>
</html>

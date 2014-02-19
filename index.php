<?php
session_start();
if( !isset($_SESSION['erro']))
{
	$_SESSION['erro']=0;
}
?>
<html><head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
		<meta name="Luciano Oliveira" content="myQuiz" >
		<link href="main.css" rel="stylesheet" type="text/css" >
		<title>myQuiz</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js" ></script>
	<script type="text/javascript" src="slimbox/js/slimbox2.js" ></script><link href="slimbox/css/slimbox2.css" rel="stylesheet" media="screen" type="text/css" >
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" >
	</head>
	
	
	<body style="background-color:#CECECE; " >
	<div style="position:relative; float:none; margin-left:auto; margin-right:auto; display:block; width:819px; height:740px; " >
		
		<div style="" id="topbar" >
		</div>
<div style="" id="navigation" >
	<a target="" alt="" href="" ></a>
</div>
<div style="" id="navigation" >
	<a target="" alt="" href="" ></a>
</div>
	<div style="" id="navigation" >
<a target="" alt="" href="" ></a></div>
		<div style="position:relative; width:900px; background-repeat-x:no-repeat; background-repeat-y:no-repeat; background-repeat:no-repeat; margin-right:0; height:378px; background-image:url(images/splash.png); " >
		</div>
		<div style="" class="strapline" >You only need your smartphone to challenge your friends
		<br>
		<?php
			if($_SESSION['erro']==1)
			{
				echo '<div style="color:red" class="strapline" >There was an error creating your game. Please try again</div>';
				$_SESSION['erro']=0;
			}
		?>
		<a href="startQuiz.php">
   		<input type="button" value="Press here to CREATE a new game" style="width:443px; height:20px; " />
		</a>
		</div>
		<div style="background-image:none; width:585px; " class="panel" >
			
		
		</div>


		
		
		
		<div style="" id="copyright" >©Luciano Oliveira 2014	design by: Vitor Martins</div></div>

</body></html>
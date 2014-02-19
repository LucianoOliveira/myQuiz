<!DOCTYPE html>
<html><head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
		<meta name="Luciano Oliveira" content="myQuiz" >
		<link href="main.css" rel="stylesheet" type="text/css" >
		<title>myQuiz</title>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js" ></script>
			<script type="text/javascript" src="slimbox/js/slimbox2.js" ></script><link href="slimbox/css/slimbox2.css" rel="stylesheet" media="screen" type="text/css" >
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
		
		
		<div style="background-image:none; width:585px; " class="panel" >
<?php
	session_start();
	
	//if error return no index
	if(isset($_SESSION['erro']) && $_SESSION['erro']==1)
	{
		$_SESSION['err_msg']='The game could not be started, an error was found';
		header("Location: index.php");
				
	}
	//if no hash found
	if(!isset($_SESSION['hash']) || $_SESSION['hash']=='')
	{
		$_SESSION['erro']=1;
		$_SESSION['err_msg']='The game could not be started, hash was not loaded';
		header("Location: index.php");
				
	}
	
	//Run WS to start the creation of the game.
	$hash = $_SESSION['hash'];
				
	$url = "http://loliveira.dynip.sapo.pt/myQuiz/wsQuiz.php?function=startGameService&hash=" .$hash."";
	$json_response = file_get_contents($url, true);

	$obj = json_decode($json_response);
	$result = $obj->{'result'};
	
	
	if($result == "Started")
	{
		$_SESSION['erro']=0;
		$_SESSION['err_msg']='';
		header("Location: quiz.php");
					
	}
	else
	{	
		$_SESSION['erro']=1;
		if($obj->{'message'}!='')
		{
			$_SESSION['err_msg']=$obj->{'message'};
		}
		else
		{
			$_SESSION['err_msg']='There was a problem starting the game';
		}	
		header("Location: index.php");
	}
		
			
?>	

</div>
	
		
		


		
		
		
		<div style="" id="copyright" >
©Luciano Oliveira 2014	design by: Vitor Martins	</div>
</div></body></html>
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
			
			//Try to create the new quiz... if sucess go to new page
			//If failed go to index with error
			$newHash = create_quiz();
			if($_SESSION['erro']==0)
			{
				$_SESSION['hash']=$newHash;
				header("Location: playQuiz.php");
				
			}
			else
			{
				header("Location: index.php");
			}
			
			
			
			function create_quiz()
			{
				$returnString = "";
				
				$url = 'http://loliveira.dynip.sapo.pt/myQuiz/wsQuiz.php?function=createQuiz';
				$json_response = file_get_contents($url, true);

				$obj = json_decode($json_response);
				$result = $obj->{'result'};
				if($result == "Created")
				{
					$hash = $obj->{'hash'};
	
					$returnString = "".$hash;
					$_SESSION['erro']=0;
					
				}
				else
				{
					$returnString = "";
					$_SESSION['erro']=1;
				}
				return $returnString;
			}
			
			
			
		?>	
		
		</div>
	
		
		


		
		
		
		<div style="" id="copyright" >
©Luciano Oliveira 2014	design by: Vitor Martins	</div>
</div></body></html>
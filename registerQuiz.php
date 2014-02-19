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
		<center>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		Device Id: <input type="text" name="device"><br>
		Game Hash: <input type="text" name="hash"><br>
		<input type="submit" value="Register">
		</form>
		</center>
		<?php
		// define variables and set to empty values
		session_start();

		if ($_SERVER["REQUEST_METHOD"] == "POST")
		{
				$device = $_POST["device"];
 				$hash = $_POST["hash"];
				
				$url = "http://loliveira.dynip.sapo.pt/myQuiz/wsQuiz.php?function=playerRegisterGame&hash=" .$hash."&player=".$device."";
				$json_response = file_get_contents($url, true);
				$obj = json_decode($json_response);
				$result = $obj->{'result'};
				if($result == "Complete")
				{
					$message = $obj->{'message'};
					$returnString = "".$message;
					//Go to page where registered
					$_SESSION['erro']=0;
					$_SESSION['hash']=$hash;
					header("Location: playQuiz.php");
					
				}
				else
				{
					$message = $obj->{'message'};
					$returnString = "".$message;
					echo $returnString;
				}
				
				
 			
		}


		?>	
		
		</div>


		
		
		
		<div style="" id="copyright" >©Luciano Oliveira 2014	design by: Vitor Martins</div>

</body></html>
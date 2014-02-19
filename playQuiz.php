<?php
$url=$_SERVER['REQUEST_URI'];
header("Refresh: 5; URL=$url"); 

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
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
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
		<?php
				session_start();
				//retrieve session data
				if( isset($_SESSION['hash']) &&  !$_SESSION['hash']=="" && $_SESSION['erro']==0)
				{
					$hash = $_SESSION['hash'];
					$url = 'http://loliveira.dynip.sapo.pt/myQuiz/wsQuiz.php?function=playersFromGame&hash=' .$hash;
					$json_response = file_get_contents($url, true);
					$names = json_decode($json_response);					
					
					$numPlayers = count($names);
					
					echo '<center>';
					echo '<div style="" class="strapline" >New game created<br>';
					echo '<strong>'.$hash.'</strong>';
					echo '</div>';
					echo '</center>';
					
					if($numPlayers>0)
					{
						//Display the button to start the game
						echo '<a href="startGame.php">
   								<input type="button" value="Start" style="width:100%; height:20px; " />
							</a>';
					}
					
					
					echo '<center>';
					echo '<table style="width:auto">';				
					for($x = 0;$x < $numPlayers;$x++)
					{
						$number = $x+1;
						echo "<tr>";
							echo "<td>Player ".$number."</td>";
							echo "<td>".$names[$x]."</td>";
						echo "</tr>";
					}					
					echo '</table>';
					echo '</center>';	
				}
				else
				{
					$_SESSION['erro']=1;
					header("Location: index.php");
				}
					
					
					
				
		?>
		
		<div style="background-image:none; width:585px; " class="panel" >
			
		
		</div>


		
		
		
		<div style="" id="copyright" >©Luciano Oliveira 2014	design by: Vitor Martins</div></div>

</body></html>
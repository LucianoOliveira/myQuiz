<?php

	$possible_url = array("createQuiz", "playersFromGame", "playerRegisterGame");

	$value = "An error has occurred";
	
	

	if (isset($_GET["function"]) && in_array($_GET["function"], $possible_url))
	{
  		switch ($_GET["function"])
    	{
      		case "createQuiz":
        		$value = createQuiz();
        		break;
      		case "playersFromGame":
        		if (isset($_GET["hash"]))
          			$value = getPlayersFromGameByHash($_GET["hash"]);
        		else
        		{
        			$arr["result"] = "Fail";
					$arr["message"] = "Missing argument";
					$value = $arr;
          		}
        		break;
        	case "playerRegisterGame":
        		if (isset($_GET["hash"]) && isset($_GET["player"]))
          			$value = registerPlayerInGame($_GET["hash"], $_GET["player"]);
        		else
        		{
          			$arr["result"] = "Fail";
					$arr["message"] = "Missing argument";
					$value = $arr;
          		}
        		break;
    	}
	}

	//return JSON array
	exit(json_encode($value));

    
    
    /**
    	Start of functions.
    
    */
    
    function registerPlayerInGame($hash, $player)
	{
		$arr = array();
		//DB Properties
    	$host = 'loliveira.dynip.sapo.pt'; 
    	$db = 'myQuiz'; 
    	$uid = 'root'; 
    	$pwd = 'whyonh';
		
		//Check if player and hash exist.
		// Connect to the database server   
        $link = mysql_connect($host, $uid, $pwd) or die("Could not connect");

        //select the json database
        mysql_select_db($db) or die("Could not select database");

        //Execute the query
        $rs = mysql_query("select * from players where p1_device='$player'");
		$playerNum = mysql_num_rows($rs);
		
		
		if($playerNum>0)
		{
				
			while($players = mysql_fetch_assoc($rs)) 
			{
				$playerID = $players["p1_id"];
			}
			mysqli_close($link);
			
			
			// Connect to the database server   
        	$link = mysql_connect($host, $uid, $pwd) or die("Could not connect");

		    //select the json database
        	mysql_select_db($db) or die("Could not select database");

        	//Execute the query
        	$rs = mysql_query("select * from quizes where q1_hash='$hash'");
			
			$gameHash = mysql_num_rows($rs);
			
			
			
			if($gameHash>0)
			{	
							
				while($quiz = mysql_fetch_assoc($rs)) 
				{
					$quizID = $quiz["q1_id"];
				}
				mysqli_close($link);
				
				
				//Check if player already registered in the game
				// Connect to the database server   
        		$link = mysql_connect($host, $uid, $pwd) or die("Could not connect");

		    	//select the json database
        		mysql_select_db($db) or die("Could not select database");

        		//Execute the query
        		$rs = mysql_query("select * from game where g1_q1_id='$quizID' and g1_p1_id='$playerID'");
		
				$quizPlayer = mysql_num_rows($rs);
				mysqli_close($link);
				
				
				if($quizPlayer>0)
				{
					//Update
					$arr["result"] = "Complete";
					$arr["message"] = "Player registered";
					
				}
				else
				{
					//Create
					// Connect to the database server   
        			$link = mysql_connect($host, $uid, $pwd) or die("Could not connect");

		    		//select the json database
        			mysql_select_db($db) or die("Could not select database");

        			//Execute the query
        			$rs = mysql_query("INSERT INTO game (g1_q1_id, g1_p1_id) VALUES ('$quizID', '$playerID')");
		
					$quizPlayer = mysql_num_rows($rs);
					mysqli_close($link);
					$arr["result"] = "Complete";
					$arr["message"] = "Player registered";
				}
				
				
			}
			else
			{
				$arr["result"] = "Fail";
				$arr["message"] = "Game not found";
			}
			
		}
		else
		{		
			$arr["result"] = "Fail";
			$arr["message"] = "Player not found";
		}
		
			//If exist
		return $arr;
	}
    
    function getPlayersFromGameByHash($hash)
	{

		//DB Properties
    	$host = 'loliveira.dynip.sapo.pt'; 
    	$db = 'myQuiz'; 
    	$uid = 'root'; 
    	$pwd = 'whyonh';
        
        // Connect to the database server   
        $link = mysql_connect($host, $uid, $pwd) or die("Could not connect");

        //select the json database
        mysql_select_db($db) or die("Could not select database");

        //Execute the query
        $rs = mysql_query("select p1_name from players where p1_id in (select g1_p1_id from game where g1_q1_id in (select q1_id from quizes where q1_hash = '$hash'))");
		
		$names_game = array();
		$check = mysql_num_rows($rs);
		if($check>0)
		{			
				while($name = mysql_fetch_assoc($rs)) 
				{
					$names_game[] = $name['p1_name'];
				}
		}
			
		//Close connection
		mysqli_close($link);
		//echo "Closed connection";

  		return $names_game;
	}
    
    
    function createQuiz()
    {
          
        
        //DB Properties
    	$host = 'loliveira.dynip.sapo.pt'; 
    	$db = 'myQuiz'; 
    	$uid = 'root'; 
    	$pwd = 'whyonh';
        
		//echo "Just before the do <br>";
		do 
		{
			$hash = generateRandomString(10);
			
			
			// Connect to the database server   
        	$link = mysql_connect($host, $uid, $pwd) or die("Could not connect");

        	//select the json database
         	mysql_select_db($db) or die("Could not select database");

        	//Execute the query
        
        	$rs = mysql_query("SELECT q1_id FROM quizes where q1_hash = '$hash'");
			$check = mysql_num_rows($rs);
			if($check>0)
			{
				echo "Found hash " . $hash ." on the Database. will try a new one<br>";
			}
			
			//Close connection
			mysqli_close($link);
			//echo "Closed connection";
			
			
			
		} while ($check > 0);
		
		if($check==0)
		{
			//Write new event
			// Connect to the database server   
        	$link = mysql_connect($host, $uid, $pwd) or die("Could not connect");

        	//select the json database
         	mysql_select_db($db) or die("Could not select database");

        	//Execute the query
        
        	$rs = mysql_query("INSERT INTO quizes (q1_hash, q1_state) VALUES ('$hash', '1')");
			
			//Close connection
			mysqli_close($link);
			//echo "Closed connection";
			
			$arr = array();
			$arr["result"] = "Created";
			$arr["hash"] = $hash;
			
		}
		else
		{
			$arr = array();
			$arr["result"] = "Not Created";
			$arr["hash"] = "";
		}
  		
        return $arr; 
    }
    
    
    
    function generateRandomString($length) 
    {
    	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    	$randomString = '';
    	for ($i = 0; $i < $length; $i++) 
    	{
        	$randomString .= $characters[rand(0, strlen($characters) - 1)];
    	}
    	return $randomString;
	}
  
?> 

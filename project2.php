<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Project 2 - William Corbett, Brian Raborn, Daniel Simpson</title>
	<link rel="stylesheet" href="themes/mytheme.min.css" />
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0/jquery.mobile.structure-1.0.min.css" />	
<script src="http://code.jquery.com/jquery-1.6.4.min.js"></script> 
	<script src="http://code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.js">
	
	
	
	</script>
	
	<?
	function checkperson($connection, $number)
{
    	
		
		return $result;
			}

function storeperson($connection, $number, $name)
{
		$query="INSERT INTO people VALUES ('$number','$name')";

		$result=mysql_query($query,$connection);
}

	$mysqli = new mysqli("localhost","wi577016","willdc","wi577016");
	/*$connection=mysql_connect("localhost","wi577016","willdc")
		or print "connect failed because ".mysql_error();  
		
    mysql_select_db("wi577016",$connection) // all projects are in ONE db
		or print "select failed because ".mysql_error(); */
		$action=$_POST['action'];
	$idnumber=$_POST['idnumber'];
	$name=$_POST['name'];
	//$resultrow=checkperson($mysqli, $idnumber);
	
	$signedin = 0;
	/*if ($resultrow->name == $name)
	{
		$signedin = 1;
		//they signed in correctly
		if ($resultrow->voted == 0)
		{
			//they haven't voted
		}
	}*/
	?>
</head> 
<body> 


	<div data-role="page" id="page1">
		<div class="theme-preview">
			<div data-role="header" data-position="inline">
				<h1>Garfield Minus Garfield!</h1>
			</div>
		
			<div class="ui-body ui-body-a" data-role="content">
			
				<p><img class = "comicpanel" src = "images/gmg1.png"  /></p>
				<?
					print "hello";
					$myquery="SELECT * FROM people where idnumber=$number";
		//$result=mysql_query($myquery,$connection) 
		  // or print "Showhistory query '$myquery' failed because ".mysql_error();
		   
		$result = $mysqli->query($myquery);
					while($row = $result->fetch_object()) 
						{
							print "wtf".$row->name."lol";
							}
							/*
					if ($signedin == 0)
					{
						print "<form method='post'>";
						print "<p><input name='idnumber' type='text'> Please enter your ID number</p>";
						print "<p><input name='name' type='text'> Please enter your name</p>";
						print "<p><input name='action' type='submit' value='Submit'>";
						print "</form>";
					}
					else
					{
					
					}*/
				?>
				
				<p class = "pageButtons"><a href="#page2" data-role="button" data-inline='true'>To Page 2</a></p>
			</div>
			<div data-role="footer">
				<h4>Page 1</h4>
			</div><!-- /footer -->

		</div>
	</div>
	
	<div data-role="page" id="page2">
		<div class="theme-preview">
			<div data-role="header" data-position="inline">
				<h1>Garfield Minus Garfield!</h1>
			</div>
		
			<div class="ui-body ui-body-a" data-role="content">
				<p><img class = "comicpanel" src = "images/gmg2.png"  /></p>
			
		-		<p class = "pageButtons"><a href="#page1" data-role="button" data-inline='true' data-transition="slide" data-direction="reverse">To Page 1</a> <a href="#page3" data-role="button" data-inline='true'>To Page 3</a></p>
			</div>
			<div data-role="footer">
				<h4>Page 2</h4>
			</div><!-- /footer -->

		</div>
	</div>
	
	<div data-role="page" id="page3">
		<div class="theme-preview">
			<div data-role="header" data-position="inline">
				<h1>Garfield Minus Garfield!</h1>
			</div>
		
			<div class="ui-body ui-body-a" data-role="content">
				<p><img class = "comicpanel" src = "images/gmg3.png" /></p>
			
				<p class = "pageButtons"><a href="#page2" data-role="button" data-inline='true' data-transition="slide" data-direction="reverse">To Page 2</a></p>
				<p class = "pageButtons"><a href="#page4" data-role="button" data-inline='true' data-transition="slide" data-direction="reverse">To Page 4</a></p>
			</div>
			<div data-role="footer">
				<h4>Page 3</h4>
			</div><!-- /footer -->

		</div>
	</div>
	
	<div data-role="page" id="page4">
		<div class="theme-preview">
			<div data-role="header" data-position="inline">
				<h1>Garfield Minus Garfield!</h1>
			</div>
		
			<div class="ui-body ui-body-a" data-role="content">
				<p><img class = "comicpanel" src = "images/gmg3.png" /></p>
			
				<p class = "pageButtons"><a href="#page2" data-role="button" data-inline='true' data-transition="slide" data-direction="reverse">To Page 2</a></p>
			</div>
			<div data-role="footer">
				<h4>Page 4</h4>
			</div><!-- /footer -->

		</div>
	</div>

</body>
</html>
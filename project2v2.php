<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Project 2 - Corbett, Raborn, Simpson</title>
	<link rel="stylesheet" href="themes/mytheme.min.css" />
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0/jquery.mobile.structure-1.0.min.css" />	
<script src="http://code.jquery.com/jquery-1.6.4.min.js"></script> 
	<script src="http://code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.js"></script>
	
	<?
$mysqli = new mysqli("localhost","wi577016","willdc","wi577016");
$selectQuery = "SELECT * FROM people";
$canvote = 0;
$blankresult = 0;
			
				$action=$_POST['action'];
				$idnumber=$_POST['idnumber'];
				$name=$_POST['name'];
	if ($action=='Submit')
	{
		$selectQuery = "SELECT * FROM people WHERE idnumber='$idnumber' AND name='$name'";
		$result = $mysqli->query($selectQuery);
			while($row = $result->fetch_object()) 
		{
			$blankresult = 1;
			
			if ($row->voted == 0)
			{
				$canvote = 1;
			}
		}
		if ($blankresult == 0)
			
			{
				$insertquery="INSERT INTO people (idnumber, name, voted) VALUES ('".$idnumber."','".$name."',0)";
				$mysqli->query($insertquery);
			}
	}
	
	if ($action=='Vote for Porky')
	{
		$newvotes = 0;
		$selectQuery = "SELECT * FROM votes where candidate='porky' ";
		$result = $mysqli->query($selectQuery);
			while($row = $result->fetch_object()) 
		{
			$newvotes = $row->total + 1;
		}
		$selectQuery = "UPDATE votes SET total='$newvotes' where candidate='porky' ";
		$result = $mysqli->query($selectQuery);
		$selectQuery = "UPDATE people SET voted='1' where name='$name' ";
		$result = $mysqli->query($selectQuery);
	}
	
	if ($action=='Vote for Buzz')
	{
		$newvotes = 0;
		$selectQuery = "SELECT * FROM votes where candidate='buzz' ";
		$result = $mysqli->query($selectQuery);
			while($row = $result->fetch_object()) 
		{
			$newvotes = $row->total + 1;
		}
		$selectQuery = "UPDATE votes SET total='$newvotes' where candidate='buzz' ";
		$result = $mysqli->query($selectQuery);
		$selectQuery = "UPDATE people SET voted='1' where name='$name' ";
		$result = $mysqli->query($selectQuery);
	}
	
	if ($action=='Vote for Johnny')
	{
		$newvotes = 0;
		$selectQuery = "SELECT * FROM votes where candidate='johnny' ";
		$result = $mysqli->query($selectQuery);
			while($row = $result->fetch_object()) 
		{
			$newvotes = $row->total + 1;
		}
		$selectQuery = "UPDATE votes SET total='$newvotes' where candidate='johnny' ";
		$result = $mysqli->query($selectQuery);
		$selectQuery = "UPDATE people SET voted='1' where name='$name' ";
		$result = $mysqli->query($selectQuery);
	}
	
	$totalQuery = "SELECT * FROM votes";
		$totalresult = $mysqli->query($totalQuery);
		
	
?>
</head> 
<body> 


	<div data-role="page" id="page1">
		<div class="theme-preview">
			<div data-role="header" data-position="inline">
				<h1>Toon Town Voting!</h1>
			</div>
		
			<div class="ui-body ui-body-a" data-role="content">
			
				<?
					if ($action == 'Submit')
					{
							
							
							
							print "<p>You are logged in as ".$resultname." good job!</p>";
							if ($canvote == 0)
							{
								print "<p>You have already voted!</p>";
							}
							if ($canvote == 1)
							{
								print "<p>You have not voted.</p>";
							
						}
						}
						if ($action=='Vote for Porky')
	{
	print "voted for porky!";
	}
					print "<form method='post'>";
					print "<p><input name='idnumber' type='text'> Please enter your ID number</p>";
					print "<p><input name='name' type='text'> Please enter your name</p>";
					print "<p><input name='action' type='submit'  value='Submit'></p>";
					print "</form>";
					print "	<p><a href=\"page2.php?idnumber=".$idnumber."&name=".$name."\" data-role=\"button\" data-inline='true' data-ajax=\"false\">Look at Porky Pig's Page</a></p>";
					
					print "	<p><a href=\"page3.php?idnumber=".$idnumber."&name=".$name."\" data-role=\"button\" data-inline='true' data-ajax=\"false\">Look at Buzz Lightyear's Page</a></p>";
					
					print "	<p><a href=\"page4.php?idnumber=".$idnumber."&name=".$name."\" data-role=\"button\" data-inline='true' data-ajax=\"false\">Look at Johnny Bravo's Page</a></p>";
					
					
					while($row = $totalresult->fetch_object()) 
					{
						if ($row->candidate == "porky")
						
						{
						print "<p>Votes for Porky Pig: ".$row->total."!";
						}
						if ($row->candidate == "buzz")
						
						{
						print "<p>Votes for Buzz Lightyear: ".$row->total."!";
						}
						if ($row->candidate == "johnny")
						
						{
						print "<p>Votes for Johnny Bravo: ".$row->total."!";
						}
					}
					
					?>
			</div>
			<div data-role="footer">
				<h4>Page 1</h4>
			</div><!-- /footer -->

		</div>
	</div>
	
	<div data-role="page" id="page2">
		<div class="theme-preview">
		
		<?
$mysqli = new mysqli("localhost","wi577016","willdc","wi577016");
$canvote = 0;			
			
				
	if ($_GET)
	{
		

				$idnumber=$_GET['idnumber'];
				$name=$_GET['name'];
		$selectQuery = "SELECT * FROM people WHERE idnumber='$idnumber' AND name='$name'";
		$result = $mysqli->query($selectQuery);
			while($row = $result->fetch_object()) 
		{
			$resultname = $row->name;
			if ($row->voted == 0)
			{
				$canvote = 1;
			}
		}
	}
	
	
	
?>
			<div data-role="header" data-position="inline">
				<h1>Garfield Minus Garfield!</h1>
				
				
			</div>
			
			<div class="ui-body ui-body-a" data-role="content">
			
				<p>This is the page for the first candidate!</p>
				<?
				
					print "Name entered: ".$name." lol";
					print "Can vote? ".$canvote."";
					print "Name from table: ".$resultname."";
					if ($canvote == 1)
					{
						print "<form method='post'>";
						print "<p><input name='vote1' type='submit' value='Vote for Porky'></p>";
						print "</form>";
					}
				?>
				<p class = "pageButtons"><a href="#page1" data-role="button" data-inline='true' data-transition="slide" data-direction="reverse">To Main Page</a> 
				<a href="#page3" data-role="button" data-inline='true'>To Second Candidate</a></p>
				
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
				<p>Second Candidate</p>
			
				<p class = "pageButtons"><a href="#page2" data-role="button" data-inline='true' data-transition="slide" data-direction="reverse">To First Candidate</a></p>
				<p class = "pageButtons"><a href="#page4" data-role="button" data-inline='true' data-transition="slide" data-direction="reverse">To Third Candidate</a></p>
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
				<p>Third Candidate!</p>
			
				<p class = "pageButtons"><a href="#page3" data-role="button" data-inline='true' data-transition="slide" data-direction="reverse">To Second Candidate</a></p>
			</div>
			<div data-role="footer">
				<h4>Page 4</h4>
			</div><!-- /footer -->

		</div>
	</div>

</body>
</html>
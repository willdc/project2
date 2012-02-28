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
$canvote = 0;			
			
				
	
		
		
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
			
				<p>This is the page for the second candidate!</p>
				
				<p><img src="images/Buzz.jpg" /></p>
				<?
				
					
					print "Logged in as: ".$resultname."";
					if ($canvote == 1)
					{
						print "<form method='post' action='project2v2.php'>";
						print "<p><input name='idnumber' type='text' style='display:none' value='".$idnumber."'> </p>";
						print "<p><input name='name' type='text' style='display:none' value='".$name."'> </p>";
						print "<p><input name='action' type='submit' data-ajax=\"false\" value='Vote for Buzz'></p>";
						print "</form>";
					}
					else
					
					{
						print "<p>You have already voted and cannot vote again.</p>";
					}
					while($row = $totalresult->fetch_object()) 
					{
						
						if ($row->candidate == "buzz")
						
						{
						print "<p>Votes for Buzz Lightyear: ".$row->total."!";
						}
						
					}
						print "	<p><a href=\"page2.php?idnumber=".$idnumber."&name=".$name."\" data-role=\"button\" data-inline='true' data-ajax=\"false\">Look at Porky Pig's Page</a></p>";
					
					print "	<p><a href=\"page3.php?idnumber=".$idnumber."&name=".$name."\" data-role=\"button\" data-inline='true' data-ajax=\"false\">Look at Buzz Lightyear's Page</a></p>";
					
					print "	<p><a href=\"page4.php?idnumber=".$idnumber."&name=".$name."\" data-role=\"button\" data-inline='true' data-ajax=\"false\">Look at Johnny Bravo's Page</a></p>";
					print "	<p><a href=\"project2v2.php\" data-ajax=\"false\">Go to Sign In Page</a></p>";
				?>
				<!--
				<p class = "pageButtons"><a href="#page1" data-role="button" data-inline='true' data-transition="slide" data-direction="reverse">To Main Page</a> 
				<a href="#page3" data-role="button" data-inline='true'>To Second Candidate</a></p>-->
			</div>
			<div data-role="footer">
				<h4>Page 1</h4>
			</div><!-- /footer -->

		</div>
	</div>

</body>
</html>
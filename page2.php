<?php

function makeHeader() {
	print '
		<!DOCTYPE html>
		<html>
		<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Project 2 - Corbett, Raborn, Simpson</title>
		<link rel="stylesheet" href="themes/mytheme.min.css" />
		<link rel="stylesheet" href="css/styles.css" />
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0.1/jquery.mobile.structure-1.0.1.min.css" />	
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
		<script type="text/javascript" src="http://code.jquery.com/mobile/1.0.1/jquery.mobile-1.0.1.min.js"></script>
		';
}

	
	makeHeader();
	
	$mysqli = new mysqli("localhost","wi577016","willdc","wi577016");
	$canvote = 0;
			
				$action=$_POST['action'];
				$idnumber=$_GET['idnumber'];
				$name=$_GET['name'];
				
	if ($action=='Submit')
	{
		$selectQuery = "SELECT * FROM people WHERE idnumber='$idnumber' AND name='$name'";
		$result = $mysqli->query($selectQuery);
			while($row = $result->fetch_object()) 
			{
				
				
				if ($row->voted == 0)
				{
					$canvote = 1;
				}
			}
		
	
	if ($action=='Vote for Porky!')
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
	}
	
	$totalQuery = "SELECT * FROM votes";
		$totalresult = $mysqli->query($totalQuery);
		
	 				
//MAIN PAGE
				
					if (!$_GET['idnumber'] || !$_GET['name']){//NOT LOGGED IN
						print '
							</head> 
							<body> 
							<div data-role="page" id="page1">

								<div data-role="header" data-position="inline">
									<a href="project2v2.php" data-role="button" data-icon="home" data-iconpos="left" data-inline="true" data-ajax="false" data-mini="true">Home</a>
									<h1>Toon Town!</h1>
								</div>
							
								<div class="ui-body ui-body-a" data-role="content">
									<h3>Porky Pig</h3> 
							
										<p>As Mayor, I p-promise to stay t-true to the v-values this great c-country was b-b-built on.</p>
										
										<img src="images/Porky.jpg" /> 
										<p>Please log-in to place a vote or view results.</p>
										<br />
							';
					}
					else if ($result = $mysqli->query("SELECT * FROM people WHERE idnumber='$idnumber' AND name='$name'")) {
								while($row=$result->fetch_object()){
									if($row->voted == 0){
											
										print '
											</head> 
											<body> 
											<div data-role="page" id="page1">
						
												<div data-role="header" data-position="inline" id="head">
													<a href="project2v2.php" data-role="button" data-icon="home" data-iconpos="left" data-inline="true" data-ajax="false" data-mini="true">Home</a>
													<a href="project2v2.php" data-role="button" data-mini="true" class="ui-btn-right">Log Out</a>
													<h1>Toon Town!</h1>
												</div>
											
												<div class="ui-body ui-body-a" data-role="content">
													<h3>Porky Pig</h3>
													<p>As Mayor, I p-promise to stay t-true to the v-values this great c-country was b-b-built on.</p>
													<img src="images/Porky.jpg" />
													<p>Thank you for logging in <i>'.$name.'</i>.</p>
													<form method="post" action="project2v2.php">
														<input name="idnumber" type="text" style="display:none" value=".$idnumber.">
														<input name="name" type="text" style="display:none" value=".$name.">
														<input name="action" type="submit" data-ajax="false" value="Vote for Porky!">
													</form>
													<br />
											';
									}
									else if($row->voted == 1){
										print '
											</head> 
											<body> 
											<div data-role="page" id="page1">
						
												<div data-role="header" data-position="inline" id="head">
													<a href="project2v2.php" data-role="button" data-icon="home" data-iconpos="left" data-inline="true" data-ajax="false" data-mini="true">Home</a>
													<a href="project2v2.php" data-role="button" data-mini="true" class="ui-btn-right">Log Out</a>
													<h1>Toon Town!</h1>
												</div>
											
												<div class="ui-body ui-body-a" data-role="content">
													<h3>Porky Pig</h3>
													<p>As Mayor, I p-promise to stay t-true to the v-values this great c-country was b-b-built on.</p>
													<img src="images/Porky.jpg" />
											<p>Thank you for logging in <i>'.$name.'</i>.
											<p>You have already voted.</p>
											';
											
										while($row = $totalresult->fetch_object()) 
										{
											if ($row->candidate == "porky")
											{
												print "<p>Votes for Porky Pig: ".$row->total."</p><br />";
											}
						
										}
									}
								}
					}						


print '<div data-role="controlgroup">
                		<ul data-role="listview" data-dividertheme="a">
               	 		<li data-role="list-divider"><h4>View the Candidates</h4></li>
                        <a href="page3.php?idnumber='.$idnumber.'&name='.$name.'"\" data-role="button" data-inline="false" data-mini="true" data-ajax="false" data-icon="arrow-r" data-iconpos="right">Buzz Lightyear</a>
                        <a href="page4.php?idnumber='.$idnumber.'&name='.$name.'"\" data-role="button" data-inline="false" data-mini="true" data-ajax="false" data-icon="arrow-r" data-iconpos="right">Johnny Bravo</a></ul>
                  </div>      
                	';





?>

			
                
                <!--<div data-role="controlgroup">
                	<ul data-role="listview" data-dividertheme="a">
               	 		<li data-role="list-divider"><h4>View the Other Candidates</h4></li>
                        <a href="page3.php?idnumber=".$idnumber."&name=".$name."\" data-role="button" data-inline="false" data-mini="true" data-ajax="false" data-icon="arrow-r" data-iconpos="right">Buzz Lightyear</a>
                        <a href="page4.php?idnumber=".$idnumber."&name=".$name."\" data-role="button" data-inline="false" data-mini="true" data-ajax="false" data-icon="arrow-r" data-iconpos="right">Johnny Bravo</a></ul>
                  </div>      -->
                	
                
				
			</div>	
			<div data-role="footer">
				<h4>Porky Pig</h4>
			</div><!-- /footer -->
</div>
</body>
</html>    
				
					
					<!--print "Logged in as: ".$resultname."";
					if ($canvote == 1)
					{
						print "<form method='post' action='project2v2.php'>";
						print "<p><input name='idnumber' type='text' style='display:none' value='".$idnumber."'> </p>";
						print "<p><input name='name' type='text' style='display:none' value='".$name."'> </p>";
						print "<p><input name='action' type='submit' data-ajax=\"false\" value='Vote for Porky'></p>";
						print "</form>";
					}
					else
					{
						print "<p>You have already voted and cannot vote again.";
					}
					while($row = $totalresult->fetch_object()) 
					{
						if ($row->candidate == "porky")
						
						{
						print "<p>Votes for Porky Pig: ".$row->total."!";
						}
						
					}
					
					print "	<p><a href=\"page2.php?idnumber=".$idnumber."&name=".$name."\" data-role=\"button\" data-inline='true' data-ajax=\"false\">Look at Porky Pig's Page</a></p>";
					
					print "	<p><a href=\"page3.php?idnumber=".$idnumber."&name=".$name."\" data-role=\"button\" data-inline='true' data-ajax=\"false\">Look at Buzz Lightyear's Page</a></p>";
					
					print "	<p><a href=\"page4.php?idnumber=".$idnumber."&name=".$name."\" data-role=\"button\" data-inline='true' data-ajax=\"false\">Look at Johnny Bravo's Page</a></p>";
					print "	<p><a href=\"project2v2.php\" data-role=\"button\" data-inline='true' data-ajax=\"false\">Go to Sign In Page</a></p>";-->
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
									<h3>Ranger Buzz Lightyear</h3> 
							
										<p>As an elite member of the Space Rangers, I promise to protect the Univerise from all evil and grow our economy to infinity and beyond!</p>
										
										<img src="images/Buzz.jpg" /> 
										<p>Please log-in to place a vote or view results.</p>
										<br />
							';
					}
					else if ($result = $mysqli->query("SELECT * FROM people WHERE idnumber='$idnumber' AND name='$name'")) {
								while($row=$result->fetch_object()){//LOGGED IN HASNT VOTED
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
													<h3>Ranger Buzz Lightyear</h3>
													<p>As an elite member of the Space Rangers, I promise to protect the Univerise from all evil and grow our economy to infinity and beyond!</p>
													<img src="images/Buzz.jpg" />
													<p>Thank you for logging in <i>'.$name.'</i>.</p>
													<form method="post" action="project2v2.php">
														<input name="idnumber" type="text" style="display:none" value="'.$idnumber.'">
														<input name="name" type="text" style="display:none" value="'.$name.'">
														<input name="action" type="submit" data-ajax="false" value="Vote for Buzz!">
													</form>
													<br />
											';
									}
									else if($row->voted == 1){//LOGGED IN ALREADY VOTED
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
													<h3>Ranger Buzz Lightyear</h3>
													<p>As an elite member of the Space Rangers, I promise to protect the Univerise from all evil and grow our economy to infinity and beyond!</p>
													<img src="images/Buzz.jpg" />
											<p>Thank you for logging in <i>'.$name.'</i>.
											<p>You have already voted.</p>
											';
											
										while($row = $totalresult->fetch_object()) 
										{
											if ($row->candidate == "buzz")
											{
												print "<p>Votes for Buzz Lightyear: ".$row->total."</p><br />";
											}
						
										}
									}
								}
					}						

print '<div data-role="controlgroup">
                		<ul data-role="listview" data-dividertheme="a">
               	 		<li data-role="list-divider"><h4>View the Candidates</h4></li>
                        <a href="page2.php?idnumber='.$idnumber.'&name='.$name.'"\" data-role="button" data-inline="false" data-mini="true" data-ajax="false" data-icon="arrow-r" data-iconpos="right">Porky Pig</a>
                        <a href="page4.php?idnumber='.$idnumber.'&name='.$name.'"\" data-role="button" data-inline="false" data-mini="true" data-ajax="false" data-icon="arrow-r" data-iconpos="right">Johnny Bravo</a></ul>
                  </div>      
                	';


?>

			
                
                <!--<div data-role="controlgroup">
                	<ul data-role="listview" data-dividertheme="a">
               	 		<li data-role="list-divider"><h4>View the Other Candidates</h4></li>
                        <a href="page2.php?idnumber=".$idnumber."&name=".$name."\" data-role="button" data-inline="false" data-mini="true" data-ajax="false" data-icon="arrow-r" data-iconpos="right">Porky Pig</a>
                        <a href="page4.php?idnumber=".$idnumber."&name=".$name."\" data-role="button" data-inline="false" data-mini="true" data-ajax="false" data-icon="arrow-r" data-iconpos="right">Johnny Bravo</a></ul>
                  </div>      -->
                	
                
				
			</div>	
			<div data-role="footer">
				<h4>Buzz Lightyear</h4>
			</div><!-- /footer -->
</div>
</body>
</html>
					
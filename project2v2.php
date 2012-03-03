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

?>
	
<?php
	
	makeHeader();
	
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
	
	if ($action=='Vote for Buzz!')
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
	
	if ($action=='Vote for Johnny!')
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
		
	 				
//HOME PAGE
				
					if (!$idnumber || !$name){//NOT LOGGED IN
						print '
							</head> 
							<body> 
							<div data-role="page" id="page1">
		
								<div data-role="header" data-position="inline">
									<h1>Toon Town!</h1>
								</div>
							
								<div class="ui-body ui-body-a" data-role="content">
									<h3>Welcome to the Toon Town Election Voting Web App!</h3> 
							
										<p>Sign in below to view election poll results or to place your vote for your favorite toon candidate.</p>
							
										<form method="post" data-transition="fade">
											<input name="idnumber" type="tel" placeholder="User ID" data-mini="true" />
											<input name="name" type="text" placeholder="Name" data-mini="true">
											<input name="action" type="submit"  value="Sign In" data-icon="check" data-iconpos="right" data-mini="true">
										</form>
										
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
													<a href="#page2" data-role="button" data-mini="true" class="ui-btn-right">Log Out</a>
													<h1>Toon Town!</h1>
												</div>
											
												<div class="ui-body ui-body-a" data-role="content">
													<h3>Welcome to the Toon Town Election Voting Web App!</h3>
											<p>Thank you for logging in <i>'.$name.'</i>.</p>
											<p>You have not voted. Please select a candidate below to compare platforms and place your vote for Mayor of Toon Town!</p>
											<br />
											';
									}
									else if($row->voted == 1){//LOGGED IN ALREADY VOTED
										print '
											</head> 
											<body> 
											<div data-role="page" id="page1">
						
												<div data-role="header" data-position="inline">
													<h1>Toon Town!</h1>
													<a href="#page2" data-role="button" data-mini="true" class="ui-btn-right">Log Out</a>
												</div>
											
												<div class="ui-body ui-body-a" data-role="content">
													<h3>Welcome to the Toon Town Election Voting Web App!</h3>
											<p>Thank you for logging in <i>'.$name.'</i>.
											<p>You have already voted. To view election poll results or to review party platforms please select a candidate below.</p>
											<br />
											';
									}
								}
					}
						
							?>
<?php					
                print '<div data-role="controlgroup">
                		<ul data-role="listview" data-dividertheme="a">
               	 		<li data-role="list-divider"><h4>View the Candidates</h4></li>
                    	
                        <a href="page2.php?idnumber='.$idnumber.'&name='.$name.'"\" data-role="button" data-inline="false" data-mini="true" data-icon="arrow-r" data-iconpos="right" >Porky Pig</a>
                        <a href="page3.php?idnumber='.$idnumber.'&name='.$name.'"\" data-role="button" data-inline="false" data-mini="true" data-ajax="false" data-icon="arrow-r" data-iconpos="right">Buzz Lightyear</a>
                        <a href="page4.php?idnumber='.$idnumber.'&name='.$name.'"\" data-role="button" data-inline="false" data-mini="true" data-ajax="false" data-icon="arrow-r" data-iconpos="right">Johnny Bravo</a></ul>
                  </div>      
                	';
                
				
					/*if ($action == 'Submit')
					{
							
							
							
						print "<p>You are logged in as: ".$resultname."</p>";
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
					print "<input name='idnumber' type='text'> Please enter your ID number</p>";
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
					}*/
					
					?>
			</div>
			<div data-role="footer">
				<h4>Home</h4>
			</div><!-- /footer -->

		
	</div>
	
	<div data-role="page" id="page2">
		<?php
			if (!$_POST['idnumber'] || !$_POST['name']){//NOT LOGGED IN
						print '
		
								<div data-role="header" data-position="inline">
									<h1>Toon Town!</h1>
								</div>
							
								<div class="ui-body ui-body-a" data-role="content">
									<h3>Welcome to the Toon Town Election Voting Web App!</h3> 
							
										<p>Sign in below to view election poll results or to place your vote for your favorite toon candidate.</p>
							
										<form method="post" data-transition="fade">
											<input name="idnumber" type="tel" placeholder="User ID" data-mini="true" />
											<input name="name" type="text" placeholder="Name" data-mini="true">
											<input name="action" type="submit"  value="Sign In" data-icon="check" data-iconpos="right" data-mini="true">
										</form>
										
										<br /> 
							';
					}
					else if ($result = $mysqli->query("SELECT * FROM people WHERE idnumber='$idnumber' AND name='$name'")) {
								while($row=$result->fetch_object()){
									if($row->voted == 0){
											
										print '
											
						
												<div data-role="header" data-position="inline" id="head">
													<a href="#page2" data-role="button" data-mini="true" class="ui-btn-right">Log Out</a>
													<h1>Toon Town!</h1>
												</div>
											
												<div class="ui-body ui-body-a" data-role="content">
													<h3>Welcome to the Toon Town Election Voting Web App!</h3>
											<p>Thank you for logging in <i>'.$name.'</i>.</p>
											<p>You have not voted. Please select a candidate below to compare platforms and place your vote for Mayor of Toon Town!</p>
											<br />
											';
									}
									else if($row->voted == 1){
										print '
											
						
												<div data-role="header" data-position="inline">
													<h1>Toon Town!</h1>
													<a href="project2v2.php" data-rel="back" data-role="button" data-mini="true" class="ui-btn-right">Log Out</a>
												</div>
											
												<div class="ui-body ui-body-a" data-role="content">
													<h3>Welcome to the Toon Town Election Voting Web App!</h3>
											<p>Thank you for logging in <i>'.$name.'</i>.
											<p>You have already voted. To view election poll results or to review party platforms please select a candidate below.</p>
											<br />
											';
									}
								}
					}
		?>
        	<div data-role="controlgroup">
                	<ul data-role="listview" data-dividertheme="a">
               	 		<li data-role="list-divider"><h4>View the Candidates</h4></li>
                    	
                        <a href="page2.php?idnumber=".$idnumber."&name=".$name."\" data-role="button" data-inline='false' data-mini="true" data-icon="arrow-r" data-iconpos="right" >Porky Pig</a>
                        <a href="page3.php?idnumber=".$idnumber."&name=".$name."\" data-role="button" data-inline='false' data-mini="true" data-ajax="false" data-icon="arrow-r" data-iconpos="right">Buzz Lightyear</a>
                        <a href="page4.php?idnumber=".$idnumber."&name=".$name."\" data-role="button" data-inline='false' data-mini="true" data-ajax="false" data-icon="arrow-r" data-iconpos="right">Johnny Bravo</a>
                        </ul>
                  </div>      
        
			
        
	</div>
	<div data-role="footer">
				<h4>Home</h4>
			</div><!-- /footer -->
            
	<div data-role="page" id="page3">
		<div class="theme-preview">
			<div data-role="header" data-position="inline">
				<h1>Garfield Minus Garfield!</h1>
			</div>
		
			<div class="ui-body ui-body-a" data-role="content">
				<!--<p><img class = "comicpanel" src = "images/gmg3.png" /></p>-->
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
				<p></p>
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

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
<?php	
	
	$mysqli = new mysqli("localhost","wi577016","willdc","wi577016") or print'Main Connection Fail on line 14';
	
	
	$blankresult = 0;
			
				$action=$_POST['action'];
				$idnumber=$_POST['idnumber'];
				$name=$_POST['name'];
				
	if ($action=='Sign In')
	{
		$selectQuery = "SELECT * FROM people WHERE idnumber='$idnumber' AND name='$name'";
		$result = $mysqli->query($selectQuery) or print'Select Query Failed on line 26';
		
		while($row = $result->fetch_object()) 
		{
			$blankresult = 1;			
		}
		if ($blankresult == 0)
			
			{
				$insertquery="INSERT INTO people (idnumber, name, voted) VALUES ('".$idnumber."', '".$name."', 0)";				
				$mysqli->query($insertquery) or print'Insert Query Failed on line 36';				
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
?>
</head> 
<body> 
<div data-role="page" id="page1">		
<?php	 				
//HOME PAGE
				
					if (!$idnumber || !$name){//NOT LOGGED IN
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
								while($row=$result->fetch_object()){//LOGGED IN HASNT VOTED
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
									else if($row->voted == 1){//LOGGED IN ALREADY VOTED
										print '						
												<div data-role="header" data-position="inline">
													<h1>Toon Town!</h1>
													<a href="#page2" data-role="button" data-mini="true" class="ui-btn-right">Log Out</a>
												</div>
											
												<div class="ui-body ui-body-a" data-role="content">
													<h3>Welcome to the Toon Town Election Voting Web App!</h3>
											<p>Thank you for logging in <i>'.$name.'</i>.
											';
										
										if ($action=='Vote for Porky!'){
											print'<h4>You Voted for Porky Pig!</h4>
												<p>Select a candidate below to view election poll results.</p>
												<br />';
										}
										else if($action=='Vote for Buzz!'){
											print'<h4>You Voted for Buzz Lightyear!</h4>
												<p>Select a candidate below to view election poll results.</p>
												<br />';
										}
										else if($action=='Vote for Johnny!'){
											print'<h4>You Voted for Johnny Bravo!</h4>
												<p>Select a candidate below to view election poll results.</p>
												<br />';
										}
										else{	
										print '<p>You have already voted. To view election poll results or to review party platforms please select a candidate below.</p>
											<br />';
										}
									}
								}
					}
						
		
                print '<div data-role="controlgroup">
                		<ul data-role="listview" data-dividertheme="a">
               	 		<li data-role="list-divider"><h4>View the Candidates</h4></li>
                    	
                        <a href="page2.php?idnumber='.$idnumber.'&name='.$name.'"\" data-role="button" data-inline="false" data-mini="true" data-icon="arrow-r" data-iconpos="right" >Porky Pig</a>
                        <a href="page3.php?idnumber='.$idnumber.'&name='.$name.'"\" data-role="button" data-inline="false" data-mini="true" data-ajax="false" data-icon="arrow-r" data-iconpos="right">Buzz Lightyear</a>
                        <a href="page4.php?idnumber='.$idnumber.'&name='.$name.'"\" data-role="button" data-inline="false" data-mini="true" data-ajax="false" data-icon="arrow-r" data-iconpos="right">Johnny Bravo</a></ul>
                  </div>      
                	';
                
					/*
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
			</div><!--CONTENT-->
			<div data-role="footer">
				<h4>Home</h4>
			</div><!-- /footer -->

		
	</div><!--PAGE ONE-->
	
	<div data-role="page" id="page2">
		<?php
			if (!$idnumber || !$name){//NOT LOGGED IN
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
									if($row->voted == 0){//LOGGED IN HASNT VOTED
											
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
									else if($row->voted == 1){//LOGGED IN ALREADY VOTED
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
		
		
		
		print '<div data-role="controlgroup">
                		<ul data-role="listview" data-dividertheme="a">
               	 		<li data-role="list-divider"><h4>View the Candidates</h4></li>
                    	
                        <a href="page2.php?idnumber='.$idnumber.'&name='.$name.'"\" data-role="button" data-inline="false" data-mini="true" data-icon="arrow-r" data-iconpos="right" >Porky Pig</a>
                        <a href="page3.php?idnumber='.$idnumber.'&name='.$name.'"\" data-role="button" data-inline="false" data-mini="true" data-ajax="false" data-icon="arrow-r" data-iconpos="right">Buzz Lightyear</a>
                        <a href="page4.php?idnumber='.$idnumber.'&name='.$name.'"\" data-role="button" data-inline="false" data-mini="true" data-ajax="false" data-icon="arrow-r" data-iconpos="right">Johnny Bravo</a></ul>
                  </div>      
                	';
		?>
 
	</div>
	<div data-role="footer">
				<h4>Home</h4>
			</div><!-- /footer -->
 </div>
</body>
</html>
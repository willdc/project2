<html><head><title>Project 2 Starter Kit:Namecheck</title>
</head><body><form method='post'>
<?php
// Checknames: Project 2 Starter Kit: DIG 4104c - Spring 12
// Moshell
// This version (project2.starter.php) demonstrates how to use a database
// to maintain two tables: one for counting visits, and one for checking names.
// 11 February 2012
// Meimei says hi, and this ought to be in the junior repos.
// Third try to push to junior origin
// 12 Feb at 0954
// 13 Feb at 1354
// on Mac at 1731 I add this.


// Added from ucflead(Mac) at 10:07 AM

$Testnumber=4;
$onmac=0; // set this to 0 if running on Sulley

function logprint($what,$when)
{global $Testnumber;
	if ($when==$Testnumber)
		print "LP:$what <br />";
}

#checkperson: return person's name if they are found; otherwise, empty string.
function checkperson($connection, $number)
{
    	$myquery="SELECT name FROM people where idnumber=$number";
		$result=mysql_query($myquery,$connection) 
		   or print "Showhistory query '$myquery' failed because ".mysql_error();
		
		if ($row=mysql_fetch_array($result))	
			return $row[0];
		else
			return '';
} # checkperson

#storeperson: Add this name and number to the 'people' table
function storeperson($connection, $number, $name)
{
		$query="INSERT INTO people VALUES ('$number','$name')";

		$result=mysql_query($query,$connection) 
		   or print "storeperson query '$query' failed because ".mysql_error();
} /* storeperson */

#erasehistory: remove all people, reset the visit counter
function erasehistory($connection)
{
		$query="TRUNCATE TABLE people";
		$result=mysql_query($query,$connection) 
		   or print "Erasehistory query '$query' failed because ".mysql_error();
		   
		$query="UPDATE visits SET count=0 WHERE item='hits'";
		$result=mysql_query($query,$connection) 
		   or print "Erasehistory query '$query' failed because ".mysql_error();
		
} # erasehistory

#checkcount: increase the visit count by one, and tell 'em about it
function checkcount($connection)
{
	$myquery="SELECT count FROM visits where item='hits'";
	$result=mysql_query($myquery,$connection) 
	   or print "Showhistory query '$myquery' failed because ".mysql_error();
	
	if ($row=mysql_fetch_array($result))	
		$hitcount=$row[0];
	else
		print "Visits table had no rows in it. query=$myquery";
	$hitcount++;
	
	$query="UPDATE visits SET count=$hitcount WHERE item='hits'";
	$result=mysql_query($query,$connection) 
	   or print "Checkcount query '$query' failed because ".mysql_error();
	return $hitcount;
}

#drawscreen1: Ask the first question
function drawscreen1($connection)
{
	$hitcount=checkcount($connection); // which increments it by one
	
	print "<p>You have visited this system $hitcount times";
	
	print "<p><input name='idnumber' type='text'> Please enter your ID number</p>";
	print "<p><input name='name' type='text'> Please enter your name</p>";
	print "<p><input name='action' type='submit' value='Submit'>";
	print "<p><input name='action' type='submit' value='Clear History'>";
	print "<p><input name='action' type='submit' value='Vote 1'>";
	print "<p><input name='action' type='submit' value='Vote 2'>";
	print "<p><input name='action' type='submit' value='Vote 3'>";
}
///////// MAIN //////////////

print "<h2>Starter Kit for DIG4104c Project 2</h2>";

// First, open the Database
/*
if ($onmac)
{
    $connection=mysql_connect("localhost","student","student")
		or print "connect failed because ".mysql_error();  
		
    mysql_select_db("project2",$connection)
		or print "select failed because ".mysql_error();
}
else // on sulley. Use your own dbname, dbuser and dbpassword
{ */
    $connection=mysql_connect("localhost","wi577016","willdc")
		or print "connect failed because ".mysql_error();  
		
    mysql_select_db("wi577016",$connection) // all projects are in ONE db
		or print "select failed because ".mysql_error();
//}

	//////// THE MAIN ACTION /////////////

	
	$idnumber=$_POST['idnumber'];
	$name=$_POST['name'];
		$action=$_POST['action'];
	if ($action=='Submit')
	{
		if (!$idnumber)
			print "With no ID number, I don't know what to do.";
		else
		{
			$maybename=checkperson($connection, $idnumber);
			if ($maybename == $name)
			{
				print "<p>You are logged in!</p>";
				
			}			
			else
			{
				//storeperson($connection, $idnumber, $name);
				
			}
		} # idnumber block
	}
	else if ($action=='Clear History') 
	{	
		erasehistory($connection);
		print "History was cleared";
	}
	else if ($action=='Vote 1')
	{
		
	}
	else if ($action=='Vote 2')
	{
		
	}
	else if ($action=='Vote 3')
	{
		
	}
	else if ($action) // ignore null, as it's probably your first visit. 
		print "What shall I do with action=$action?";

	drawscreen1($connection);
?>
</form></body></html>

<?php
include '..\dataaccess\db.inc.php';
require_once 'api.password.php';

//try to login
$username = $_POST['username'];
$password = $_POST['password'];
$tablePrefix = "";
$userTable = $tablePrefix . "employee";


$query = "SELECT * FROM {$userTable} WHERE employeeusername='{$username}'";
$pdo = new BaseDB();
$pdo->connectDatabase();
$result = $pdo->query( $query );
if( !$result ) {
	//an error occured
	die( "There was a problem executing the SQL query. MySQL error returned: {$pdo->error} (Error #{$pdo->errno})" );
}

if( !$result->num_rows ) {
	//no results found
	die( "This user does not exist."  );
}

//get the user as an object
while( $row = $result->fetch_assoc() ) 
	$user = (object) $row;

//free the memory, discard the db query
$result->free();

//verify the passwords match
$matches = password_verify( $password, $user->employeePassword );
if( !$matches ) 
	die( "Invalid password.");

echo 	"<h1>Logged in as user:</h1>" .
		"<pre>" . print_r( $user, true ) . "<pre>";

<?php
session_start();

	global $cxn;
	
	function recordkeeping()
	{
		global $cxn;
		
		session_id();
		$_SERVER['GATEWAY_INTERFACE'];
		$_SERVER['SERVER_ADDR'];
		$_SERVER['SERVER_NAME'];
		$_SERVER['SERVER_PROTOCOL'];
		$_SERVER['REQUEST_METHOD'];
		$_SERVER['REQUEST_TIME'];
		$_SERVER['QUERY_STRING'];
		$_SERVER['HTTP_ACCEPT'];
		$_SERVER['HTTP_ACCEPT_CHARSET'];
		$_SERVER['HTTP_ACCEPT_ENCODING'];
		$_SERVER['HTTP_ACCEPT_LANGUAGE'];
		$_SERVER['HTTP_CONNECTION'];
		$_SERVER['HTTP_HOST'];
		$_SERVER['HTTP_USER_AGENT'];
		$_SERVER['REMOTE_ADDR'];
		$_SERVER['REMOTE_PORT'];
		$_SERVER['SCRIPT_FILENAME'];
		$_SERVER['SERVER_PORT'];
		$_SERVER['SCRIPT_NAME'];
		$_SERVER['REQUEST_URI'];

		
		mysqli_query($cxn, $query);	
	}
	
	
echo "<table border=\"1\">";
echo "<tr><td>" .session_id() ."</td><td>Session ID</td></tr>";
echo "<tr><td>" .$_SERVER['GATEWAY_INTERFACE'] ."</td><td>GATEWAY_INTERFACE</td></tr>";
echo "<tr><td>" .$_SERVER['SERVER_ADDR'] ."</td><td>SERVER_ADDR</td></tr>";
echo "<tr><td>" .$_SERVER['SERVER_NAME'] ."</td><td>SERVER_NAME</td></tr>";
echo "<tr><td>" .$_SERVER['SERVER_PROTOCOL'] ."</td><td>SERVER_PROTOCOL</td></tr>";
echo "<tr><td>" .$_SERVER['REQUEST_METHOD'] ."</td><td>REQUEST_METHOD</td></tr>";
echo "<tr><td>" .$_SERVER['REQUEST_TIME'] ."</td><td>REQUEST_TIME</td></tr>";
echo "<tr><td>" .$_SERVER['QUERY_STRING'] ."</td><td>QUERY_STRING</td></tr>";
echo "<tr><td>" .$_SERVER['HTTP_ACCEPT'] ."</td><td>HTTP_ACCEPT</td></tr>";
echo "<tr><td>" .$_SERVER['HTTP_ACCEPT_CHARSET'] ."</td><td>HTTP_ACCEPT_CHARSET</td></tr>";
echo "<tr><td>" .$_SERVER['HTTP_ACCEPT_ENCODING'] ."</td><td>HTTP_ACCEPT_ENCODING</td></tr>";
echo "<tr><td>" .$_SERVER['HTTP_ACCEPT_LANGUAGE'] ."</td><td>HTTP_ACCEPT_LANGUAGE</td></tr>";
echo "<tr><td>" .$_SERVER['HTTP_CONNECTION'] ."</td><td>HTTP_CONNECTION</td></tr>";
echo "<tr><td>" .$_SERVER['HTTP_HOST'] ."</td><td>HTTP_HOST</td></tr>";
echo "<tr><td>" .$_SERVER['HTTP_USER_AGENT'] ."</td><td>HTTP_USER_AGENT</td></tr>";
echo "<tr><td>" .$_SERVER['REMOTE_ADDR'] ."</td><td>REMOTE_ADDR</td></tr>";
echo "<tr><td>" .$_SERVER['REMOTE_PORT'] ."</td><td>REMOTE_PORT</td></tr>";
echo "<tr><td>" .$_SERVER['SCRIPT_FILENAME'] ."</td><td>SCRIPT_FILENAME</td></tr>";
echo "<tr><td>" .$_SERVER['SERVER_PORT'] ."</td><td>SERVER_PORT</td></tr>";
echo "<tr><td>" .$_SERVER['SCRIPT_NAME'] ."</td><td>SCRIPT_NAME</td></tr>";
echo "<tr><td>" .$_SERVER['REQUEST_URI'] ."</td><td>REQUEST_URI</td></tr>";
echo "</table>";


?>


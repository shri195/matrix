<?php
/*ldap://harbinger.com:389;OU=HSPL,DC=harbinger,DC=com*/
if(isset($_POST['submit']) && $_POST['submit'] == "Submit") {

	$username = $_POST['txtUsername'];
	 $password = $_POST['txtPass'];	
	
	
	$dn = "DC=harbinger,DC=in";
	//$ldaphost = "harbinger.in";  
	//$ldaphost = "ldap://192.168.2.228";  
	
	$ldaphost = "ldap://10.0.0.2";
	$ldapport = 389;
	
	$ds = ldap_connect($ldaphost, $ldapport);  // assuming the LDAP server is on this host
	
	$filter = "(cn=*)";
	$attributes = array();
	
	if ($ds) {
	
	    $extusername = $username . '@harbinger.in';
	   // bind with appropriate dn to give update access
	    $isValid = @ldap_bind($ds, $extusername, $password);	 
	   if($isValid)
	   {
		   
		   $result = @ldap_search($ds, $dn, $filter, $attributes);
			if(!$result)
			{
				die("Error in search:" . ldap_error($ds));
			}
			$entries = ldap_get_entries($ds, $result);
		   
	
			echo "<br>Login Successful<br>";exit;
			
			
			
			
			
	   }
	   else
	   {
			echo "Not valid credentials";
			
			return false;
			
	   }
	   ldap_close($ds);
	} 
	else 
	{
	   echo "Unable to connect to LDAP server";
	}
	
	
}
?>
<html>
<body>
<form name="myform" action="" method="post">
Username : <input type="text" name="txtUsername" /><br />
Password : <input type="password" name="txtPass" /><br />
<input type="submit" name="submit" value="Submit" />
</form>
</body>
</html>
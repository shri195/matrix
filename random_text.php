<?php
$n=7; 
function getName($n) { 
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
    $randomString = ''; 
  
    for ($i = 0; $i < $n; $i++) { 
        $index = rand(0, strlen($characters) - 1); 
        $randomString .= $characters[$index]; 
    } 
  
    return $randomString; 
} 

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$conn = mysql_connect($dbhost, $dbuser, $dbpass);
mysql_select_db('matrix');

//for employee 
$sql_Skil_Level = "SELECT * FROM content_type_employee WHERE 1 ORDER BY nid desc";

$retval_Skil_Level = mysql_query( $sql_Skil_Level, $conn );

while($row_Skil_Level = mysql_fetch_row($retval_Skil_Level))
{   
   $name = getName($n);
   $name2 = getName($n);
   
   $email = $name .'.'.$name2.'@harbingergroup.com';  
  
   $title = $name .' '. $name2;

   $sql_query = "UPDATE content_type_employee SET field_emp_first_name_value = '".ucfirst($name)."', field_emp_last_name_value = '".ucfirst($name2)."', field_emp_email_id_value = '".$email."', field_emp_connect_profile_url='' WHERE nid =".$row_Skil_Level[1];
   
   mysql_query($sql_query);   
   
   $sql_query2 = "UPDATE node SET title = '".ucfirst($title)."' WHERE nid =".$row_Skil_Level[1];
   mysql_query($sql_query2); 

   $sql_query3 = "UPDATE node_revisions SET title = '".ucfirst($title)."' WHERE nid =".$row_Skil_Level[1];
   mysql_query($sql_query3);    
   
}


//for project 
$sql_Skil_Level2 = "SELECT * FROM content_type_project_overview WHERE 1 ORDER BY nid desc";

$retval_Skil_Level2 = mysql_query( $sql_Skil_Level2, $conn );

while($row_Skil_Level2 = mysql_fetch_row($retval_Skil_Level2))
{   
   $name = getName($n);
   
   $sql_query = "UPDATE content_type_project_overview SET field_project_name_value = '".ucfirst($name)."' WHERE nid =".$row_Skil_Level2[1];   
   mysql_query($sql_query);   
   
   $sql_query2 = "UPDATE node SET title = '".ucfirst($name)."' WHERE nid =".$row_Skil_Level2[1];
   mysql_query($sql_query2); 

  $sql_query3 = "UPDATE node_revisions SET title = '".ucfirst($name)."' WHERE nid =".$row_Skil_Level2[1];
   mysql_query($sql_query3);   
   
}
?>
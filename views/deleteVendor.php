<?php 
require_once('helpers.php');


$eid=$_POST['eid'];
$r=query("select img from vendor where id='$eid';");
while($row=mysqli_fetch_array($r))
{
  $path=$row['img'];
}

  if($path)
  { 
    $newpath="../".$path;
  if (file_exists($newpath))
  {
    unlink($newpath);
  } 
  }

$r=query("delete from vendor where id='$eid';");
if(!$r)
echo 'false';
else
echo 'true';
?>
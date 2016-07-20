<?php
session_start();


if(isset($_SESSION['email'])) {

$_SESSION['firstVisit']=true;

}else{
      echo"notlogged";
}

?>

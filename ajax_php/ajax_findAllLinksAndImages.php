<?php
session_start();
//https://ruseller.com/lessons.php?rub=37&id=639
//http://simplehtmldom.sourceforge.net/manual.htm  - list of selectors

include('../Classes/My_Simple_Html_Dom.php');

$_SESSION['flag'] = 1;

My_Simple_Html_Dom::findAllLinksAndImages($_POST['serverUrl']);



 ?>
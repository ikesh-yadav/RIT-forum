<?php
include_once('mysql.php');
// Array with names
$a=[];
$sql="Select name from category";
$result=$link->query($sql);
while($row=$result->fetch_assoc()){
    $a[]=$row['name'];
}
// get the q parameter from URL
$category_hint = $_REQUEST["category"];

$hint = "";

// lookup all hints from array if $category_hint is different from ""
if ($category_hint !== "") {
    $category_hint = strtolower($category_hint);
    $len=strlen($category_hint);
    foreach($a as $name) {
        if (stristr($category_hint, substr($name, 0, $len))) {
            if ($hint === "") {
                $hint = $name;
            } else {
                $hint .= ", $name";
            }
        }
    }
}

// Output "no suggestion" if no hint was found or output correct values
echo $hint === "" ? "no suggestion" : $hint;
?>
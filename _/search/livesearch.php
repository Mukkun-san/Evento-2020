<?php

$xmlDoc=new DOMDocument();

$xmlDoc->load("links.xml");

// $x is an array of all links from the xml
$x=$xmlDoc->getElementsByTagName('link');

//get the search keyword from URL
$q=$_GET["s"];

//lookup all links from the xml file if length of q>0
if (strlen($q)>0) {
  $hint="";
  for($i=0; $i<($x->length); $i++) {
    // $y contains title
    $y=$x->item($i)->getElementsByTagName('title');
    // $y contains title
    $z=$x->item($i)->getElementsByTagName('url');
    if ($y->item(0)->nodeType==1) {
      //find a link matching the search text
      if (stristr($y->item(0)->childNodes->item(0)->nodeValue,$q)) {
        if ($hint=="") {
          $hint="<a href='" .
          $z->item(0)->childNodes->item(0)->nodeValue .
          "' target='_blank'> " .
          $y->item(0)->childNodes->item(0)->nodeValue . "</a><br>
          ";
        } else {
          $hint=$hint . "<a href='" .
          $z->item(0)->childNodes->item(0)->nodeValue .
          "' target='_blank'>" .
          $y->item(0)->childNodes->item(0)->nodeValue . "</a><br>
          ";
        }
      }
    }
  }
}

// Set output to "NO RESULT FOUND" if no hint was found
// or to the correct values otherwise"
if ($hint=="") {
  $response='<h4>NO RESULT FOUND</h4>' ;
} else {
  $response=$hint;
}
//output the response
echo $response ;
?>

<style>
      #livesearch{
        background : white ;
        padding : 10px 100px;
        margin : 0 20px ;
      }
      #livesearch a{
        color: #b36b00  !important ;   
        font-size: 30px ; 
      }
      #livesearch a:hover{
        margin: 50px 20px;
        font-size: 35px ; 
        color: #b00b00 ;
      }
</style>
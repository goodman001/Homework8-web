<?php
$category = $_GET["category"];
if($category == 0 )
{
   $url='https://congress.api.sunlightfoundation.com/legislators?per_page=all&apikey=542bae46d15c4c5c99bb423075fda3a7';
   $html=file_get_contents($url); 
   echo $html;
  
}


//if($flag ==1){
//$list=array("name"=>"wang","sex"=>"man","tel"=>"123","email"=>"xxx@126.com"); 
//$list1=array("name"=>"sdfa","sex"=>"g","tel"=>"ddd","email"=>"ccc126.com"); 
//$re = array($list,$list1);
    //echo '{"records":[{"name":3,"city":"wash"},{"name":5,"city":"22222222"},{"name":6,"city":"a1111111"}]}';
    //echo '{"records":[{"name":3,"city":"wash","cn":"xx"},{"name":3,"city":"wash","cn":"xx"},{"name":3,"city":"wash","cn":"xx"},{"name":3,"city":"wash","cn":"xx"},{"name":3,"city":"wash","cn":"xx"},{"name":3,"city":"wash","cn":"xx"},{"name":5,"city":"22222222","cn":"xx"},{"name":6,"city":"a1111111","cn":"xx"}]}';
?>

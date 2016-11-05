<?php
$category = $_GET["category"];
$detail = $_GET["detail"];
$bioguide_id = $_GET["bioguide_id"];
$billid = $_GET["billid"];
$bill = $_GET["bill"];
if($category == '1' )
{
   $url='https://congress.api.sunlightfoundation.com/legislators?fields=party,chamber,district,state,bioguide_id,last_name,first_name&per_page=all&apikey=542bae46d15c4c5c99bb423075fda3a7';
   $html=file_get_contents($url); 
   echo $html;
}else if($category =='house')
{
    $url='https://congress.api.sunlightfoundation.com/legislators?fields=party,chamber,district,state,bioguide_id,last_name,first_name&chamber='.$category.'&per_page=all&apikey=542bae46d15c4c5c99bb423075fda3a7';
    $html=file_get_contents($url);
    echo $html;
}else if($category =='senate')
{
    $url='https://congress.api.sunlightfoundation.com/legislators?fields=party,chamber,district,state,bioguide_id,last_name,first_name&chamber='.$category.'&per_page=all&apikey=542bae46d15c4c5c99bb423075fda3a7';
    $html=file_get_contents($url);
    echo $html;
}
else if(!empty($category))
{
    $url='https://congress.api.sunlightfoundation.com/legislators?fields=party,chamber,district,state,bioguide_id,last_name,first_name&state_name='.$category.'&per_page=all&apikey=542bae46d15c4c5c99bb423075fda3a7';
    $html=file_get_contents($url);
    echo $html;
}
if($detail == 1&&$bioguide_id != '')
{
    
    $url='https://congress.api.sunlightfoundation.com/legislators?fields=bioguide_id,title,first_name,last_name,oc_email,chamber,phone,party,term_start,term_end,office,state_name,fax,birthday,twitter_id,facebook_id,contact_form&bioguide_id='.$bioguide_id.'&per_page=all&apikey=542bae46d15c4c5c99bb423075fda3a7';
    $html=file_get_contents($url);
    $array1 = json_decode($html, true);
    /*get date*/
    $birthday = strtotime($array1['results'][0]['birthday']);
    $term_start = strtotime($array1['results'][0]['term_start']);
    $term_end = strtotime($array1['results'][0]['term_end']);
    $now = time();
    $days=intval(round($now-$term_start)/round($term_end-$term_start)*100);
    //echo $days;
    //var_dump($array1['results'][0]['birthday']);
    

    //$urlbill='https://congress.api.sunlightfoundation.com/bills?fields=last_version.urls.pdf&sponsor.bioguide_id='.$bioguide_id.'&per_page=all&apikey=542bae46d15c4c5c99bb423075fda3a7';

    $urlbill='https://congress.api.sunlightfoundation.com/bills?fields=bill_id,official_title,chamber,bill_type,congress,last_version.urls.pdf&sponsor.bioguide_id='.$bioguide_id.'&per_page=all&apikey=542bae46d15c4c5c99bb423075fda3a7';
    $html=file_get_contents($urlbill);
    $array2 = json_decode($html, true);
    //var_dump($array2['results'][0]['last_version']);
    $flag = count($array2['results']);
    if($flag >5)
    {
        $flag =5;
    }
    $arrbill = [];
    for($i=0;$i<$flag;$i++)
    {
        $arrbill[$i] = ["bill_id" => $array2['results'][$i]['bill_id'],"official_title"=>$array2['results'][$i]['official_title'],"chamber"=>$array2['results'][$i]['chamber'],"bill_type" => $array2['results'][$i]['bill_type'],"congress" => $array2['results'][$i]['congress'],"pdf"=>$array2['results'][$i]['last_version']['urls']['pdf']];
    }
    /* Get commit*/
    $urlcom='https://congress.api.sunlightfoundation.com/committees?fields=committee_id,name,chamber&member_ids='.$bioguide_id.'&per_page=all&apikey=542bae46d15c4c5c99bb423075fda3a7';
    $html=file_get_contents($urlcom);
    $array3 = json_decode($html, true);
    $flag = count($array3['results']);
    if($flag >5)
    {
       $flag = 5;
    } 
    $arrcom = [];
    for($i=0;$i<$flag;$i++)
    {
        $arrcom[$i] = $array3['results'][$i];
    }
    //var_dump($array3['results']);
    //if()
    //echo strtotime($array1['results'][0]['birthday']);
    $array1['results'][0]['term'] = $days;
    $array1['results'][0]['birthday'] = date('F j, Y',$birthday);
    $array1['results'][0]['term_start'] = date('F j, Y',$term_start);
    $array1['results'][0]['term_end'] = date('F j, Y',$term_end);
    $array1['results'][0]['bills'] = $arrbill; 
    $array1['results'][0]['committee'] = $arrcom;
    $res = json_encode($array1, true);
    echo $res;
    #var_dump($array1['results'][0]);

}else if($detail == 2 && $billid != '')
{
    $url='https://congress.api.sunlightfoundation.com/bills?fields=bill_id,chamber,bill_type,sponsor,urls,last_version,history,introduced_on&bill_id='.$billid.'&per_page=all&apikey=542bae46d15c4c5c99bb423075fda3a7';
    $html=file_get_contents($url);
    echo $html;

}

if($bill == 'true' || $bill == 'false' )
{
    $url='https://congress.api.sunlightfoundation.com/bills?fields=bill_id,chamber,bill_type,sponsor,introduced_on&history.active='.$bill.'&per_page=all&apikey=542bae46d15c4c5c99bb423075fda3a7';
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

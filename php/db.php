<?php
session_start();
date_default_timezone_set("PRC");
class WJRdb{
    function connect()
    {
        $con=mysql_connect("localhost","ivy","952254420");
        if(!$con)die("Error");
        mysql_select_db("zero_cup_2017");
    }
    function query($sqlinfo,$needminsize=1)
    {
        if(strpos($sqlinfo,"delete")===0||strpos($sqlinfo,"update")===0)mysql_query($sqlinfo);
        else if(strpos($sqlinfo,"insert")===0){
            mysql_query($sqlinfo);
            $res=mysql_insert_id();
        }else if(strpos($sqlinfo,"select")===0)
        {
            $result=mysql_query($sqlinfo);
            $res=array();
            while($tmp=mysql_fetch_array($result))array_push($res,$tmp);
            if(count($res)==1&&$needminsize)$res=$res[0];
        }return $res;
    }
}
?>
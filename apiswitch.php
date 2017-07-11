<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-07-11
 * Time: 14:12:28
 */
$type = $_GET['type'];
if($type=="qtjob") //òßòÑ¼æÖ°
{
    $arr = array(
        "isopen"=>true
    );
    echo json_encode($arr);
    die();
}

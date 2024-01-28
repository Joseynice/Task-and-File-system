<?php

include_once('../config/dbconfig.php');

function getRecentUpdate($db){
    $sql = "SELECT * from properties ORDER BY id DESC LIMIT 3";
    $res = $db->query($sql);
    return $res;
}

function getBungalow($db){
    $sql = "SELECT * from properties where category_id = 2 ORDER BY id DESC LIMIT 3";
    $res = $db->query($sql);
    return $res;
}
function getDuplexe($db){
    $sql = "SELECT * from properties where category_id = 1 ORDER BY id DESC LIMIT 3";
    $res = $db->query($sql);
    return $res;
}

function getHotel($db){
    $sql = "SELECT * from properties where category_id = 3 ORDER BY id DESC LIMIT 3";
    $res = $db->query($sql);
    return $res;
}

function getMansion($db){
    $sql = "SELECT * from properties where category_id = 4 ORDER BY id DESC LIMIT 3";
    $res = $db->query($sql);
    return $res;
}
//function getCategory($db){
//    $category_id = $_GET['id'];
//    $sql = "SELECT * from properties WHERE category_id = '$category_id' ORDER BY id DESC";
//    $res = $db->query($sql);
//    return $res;
//}
function getDetail($db){
    $property_id= $_GET['id'];
    $sql = "SELECT * from properties WHERE property_id = '$property_id' ORDER BY id DESC";
    $res = $db->query($sql);
    return $res;
}
?>
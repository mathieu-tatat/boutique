<?php


if(isset($_GET['searchBarIn'])){
    header('location:');
    $test=$_GET['searchBarIn'];
    $search=new Search();
    $search_result=$search->searchAll($test);

}
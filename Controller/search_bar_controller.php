<?php


if(isset($_GET['searchBarIn'])){
    $test=$_GET['searchBarIn'];
    $search=new Search();
    $items=$search->searchAll($test);
    //var_dump($items);
}
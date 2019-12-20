<?php

    ini_set("display_errors", 1);
    ini_set('memory_limit', '-1');
	include('html_dom_parser.php');

    $html = file_get_html("https://nzasa.org/find-a-practitioner/show?start=0");

    // $tBody = $html->find('#MemberList tbody'); 
    foreach($html->find('#MemberList tbody') as $key => $val) {

        foreach ($val->children() as $k => $vaal) {

            // $elementNew = $vaal->innertext();
            echo '<pre>'. $k;
            var_dump($vaal->innertext);
        }

    }

    // echo '<pre>';
    // print_r($html);


?>
<?php

    include (__DIR__ . '/model/db.php');
    

    global $db;
     $sql = "SELECT country, population FROM country_table ORDER BY population DESC";
    $stmt = $db->query ($sql);

   $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
   $results[0] = array(); // list countries
   $results[1] = array (); // populations

    foreach ($data as $v) {
        array_push($results[0], $v['country']);
        array_push($results[1], $v['population']);
    }
    $jsonResults= json_encode($results);
    //var_dump($jsonResults);
    echo $jsonResults;
   
   
?>
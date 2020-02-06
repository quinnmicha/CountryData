<?php

    include (__DIR__ . '/model/db.php');
    

    global $db;
    
    $sort = filter_input(INPUT_GET, 'order');    
    $year = filter_input(INPUT_GET, 'birthYear');

    
     $sql = "SELECT country, foundedYear FROM country_table WHERE foundedYear >= " . $year  . " ORDER BY " . $sort;
    $stmt = $db->query ($sql);

   $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
   $results[0] = array(); // list countries
   $results[1] = array (); // populations

    foreach ($data as $v) {
        array_push($results[0], $v['country']);
        array_push($results[1], $v['foundedYear']);
    }
    $jsonResults= json_encode($results);
    //var_dump($jsonResults);
    echo $jsonResults;
   
   
?>

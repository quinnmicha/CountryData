<?php 
    include ('db.php');
    
    function getPopulation(){
        global $db;
        
        $stmt = $db->prepare("SELECT country, population FROM country_table");
        
        $results = array();
        if($stmt->execute() && $stmt->rowCount() > 0){
            $results = $stmt-> fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
        
        //echo $results;
    }
    
     $test= getPopulation();
     var_dump($test);
    



    
?>
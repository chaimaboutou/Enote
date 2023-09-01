<?php 


// All classes
function getAllYearss($conn){
   $sql = "SELECT * FROM collegeyear";
   $stmt = $conn->prepare($sql);
   $stmt->execute();

   if ($stmt->rowCount() >= 1) {
    $years = $stmt->fetchAll();
     return $years;
   }else {
    return 0;
   }
}
// Get class by ID
function getYearById($year_id, $conn){
   $sql = "SELECT * FROM collegeyear
           WHERE idannee=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$year_id]);

   if ($stmt->rowCount() == 1) {
     $current_year = $stmt->fetch();
     return $current_year;
   }else {
    return 0;
   }
}

function getCurrentYear($year, $conn){
   $sql = "SELECT * FROM collegeyear
           WHERE nom=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$year]);

   if ($stmt->rowCount() == 1) {
     $current_year = $stmt->fetch();
     return $current_year;
   }else {
    return 0;
   }
}




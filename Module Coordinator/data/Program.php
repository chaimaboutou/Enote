<?php 
// All classes
function getAllPrograms($conn){
   $sql = "SELECT * FROM program";
   $stmt = $conn->prepare($sql);
   $stmt->execute();

   if ($stmt->rowCount() >= 1) {
     $programs = $stmt->fetchAll();
     return $programs;
   }else {
    return 0;
   }
}

// Get class by ID
function getProgramById($program_id, $conn){
   $sql = "SELECT * FROM program
           WHERE idFiliere=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$program_id]);

   if ($stmt->rowCount() == 1) {
     $program = $stmt->fetch();
     return $program;
   }else {
    return 0;
   }
}

// DELETE
function removeProgram($id, $conn){
   $sql  = "DELETE FROM program
           WHERE idFiliere=?";
   $stmt = $conn->prepare($sql);
   $re   = $stmt->execute([$id]);
   if ($re) {
     return 1;
   }else {
    return 0;
   }
}
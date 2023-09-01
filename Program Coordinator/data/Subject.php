<?php 
// All classes
function getAllSubjects($conn){
   $sql = "SELECT * FROM subject";
   $stmt = $conn->prepare($sql);
   $stmt->execute();

   if ($stmt->rowCount() >= 1) {
    $subjects = $stmt->fetchAll();
     return $subjects;
   }else {
    return 0;
   }
}

// Get class by ID
function getSubjectById($subject_id, $conn){
   $sql = "SELECT * FROM subject
           WHERE idmatiere=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$subject_id]);

   if ($stmt->rowCount() == 1) {
     $subject = $stmt->fetch();
     return $subject;
   }else {
    return 0;
   }
}
function getSubjectOfModule($module_id, $conn){
   $sql = "SELECT * FROM subject
           WHERE idmodule=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$module_id]);

   if ($stmt->rowCount() >= 1) {
      $subjects = $stmt->fetchAll();
      return $subjects;
   } else {
      return []; // Return an empty array if no subjects are found
   }
}



// DELETE
function removeSubject($id, $conn){
   $sql  = "DELETE FROM subject
           WHERE idmatiere=?";
   $stmt = $conn->prepare($sql);
   $re   = $stmt->execute([$id]);
   if ($re) {
     return 1;
   }else {
    return 0;
   }
}
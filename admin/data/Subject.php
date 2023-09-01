<?php 

function countsubject($conn){
   $sql = "SELECT COUNT(*) FROM subject ";
   $stmt = $conn->prepare($sql);
   $stmt->execute();
 
   $count = $stmt->fetchColumn();
 
   return $count;
 }
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

// Search 
function searchSubjects($key, $conn){
   $key = preg_replace('/(?<!\\\)([%_])/', '\\\$1', $key);
 
   $sql = "SELECT * FROM subject where
           nom LIKE ?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$key]);
 
   $subjects = $stmt->fetchAll();
 
   if (count($subjects) > 0) {
     return $subjects;
   } else {
     return 0;
   }
 }
 
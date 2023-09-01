<?php 
// All classes
function getSessionsOfProfCYear($id_prof,$id_year , $conn){
   $sql = "SELECT * FROM session WHERE idtilisateur=? AND idannee=? ";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$id_prof,$id_year]);

   if ($stmt->rowCount() >= 1) {
    $sessions = $stmt->fetchAll();
     return $sessions;
   }else {
    return 0;
   }
}

// Get class by ID
function getSessiontById($session_id, $conn){
   $sql = "SELECT * FROM session
           WHERE idseance=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$session_id]);

   if ($stmt->rowCount() == 1) {
     $session = $stmt->fetch();
     return $session;
   }else {
    return 0;
   }
}

// DELETE
function removeSession($id, $conn){
   $sql  = "DELETE FROM session
           WHERE idseance=?";
   $stmt = $conn->prepare($sql);
   $re   = $stmt->execute([$id]);
   if ($re) {
     return 1;
   }else {
    return 0;
   }
}
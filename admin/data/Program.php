<?php 

function countprogram($conn){
  $sql = "SELECT COUNT(*) FROM program ";
  $stmt = $conn->prepare($sql);
  $stmt->execute();

  $count = $stmt->fetchColumn();

  return $count;
}
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
// Search 
function searchprograms($key, $conn){
  $key = preg_replace('/(?<!\\\)([%_])/', '\\\$1', $key);

  $sql = "SELECT * FROM program where
          nom LIKE ?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$key]);

  $programs = $stmt->fetchAll();

  if (count($programs) > 0) {
    return $programs;
  } else {
    return 0;
  }
}
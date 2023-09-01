<?php 
// All classes
function getAllModules($conn){
   $sql = "SELECT * FROM module";
   $stmt = $conn->prepare($sql);
   $stmt->execute();

   if ($stmt->rowCount() >= 1) {
     $modules = $stmt->fetchAll();
     return $modules;
   }else {
    return 0;
   }
}


function getModuleById($module_id, $conn){
   $sql = "SELECT * FROM module
           WHERE idmodule=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$module_id]);

   if ($stmt->rowCount() == 1) {
     $modules = $stmt->fetch();
     return $modules;
   }else {
    return 0;
   }
}

function getModulesByIdCoordModule($moduleCoord_id, $conn){
  $sql = "SELECT * FROM module
          WHERE idCoordMod=?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$moduleCoord_id]);

  if ($stmt->rowCount() >= 1) {
    $modules = $stmt->fetchAll(); // Fetch all modules, not just one
    return $modules;
  } else {
    return []; // Return an empty array if no modules are found
  }
}



// DELETE
function removeModule($id, $conn){
   $sql  = "DELETE FROM module
           WHERE idmodule=?";
   $stmt = $conn->prepare($sql);
   $re   = $stmt->execute([$id]);
   if ($re) {
     return 1;
   }else {
    return 0;
   }
}
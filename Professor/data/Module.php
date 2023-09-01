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

// Get class by ID
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
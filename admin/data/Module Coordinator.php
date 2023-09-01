<?php  

function countModuleCoords($conn){
  $sql = "SELECT COUNT(*) FROM user WHERE role = 'Module Coordinator'";
  $stmt = $conn->prepare($sql);
  $stmt->execute();

  $count = $stmt->fetchColumn();

  return $count;
}

function getModuleCoordById($idUtilisateur, $conn){
   $sql = "SELECT * FROM user
           WHERE role = 'Module Coordinator' and idUtilisateur=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$idUtilisateur]);

   if ($stmt->rowCount() == 1) {
    $Module_Coordinator = $stmt->fetch();
     return $Module_Coordinator;
   }else {
    return 0;
   }
}


function getAllModuleCoords($conn){
   $sql = "SELECT * FROM user WHERE role = 'Module Coordinator' ";
   $stmt = $conn->prepare($sql);
   $stmt->execute();

   if ($stmt->rowCount() >= 1) {
    $Module_Coordinators = $stmt->fetchAll();
     return $Module_Coordinators ;
   }else {
   	return 0;
   }
}
// Check if the ID is Unique
function idcordModIsUnique($id, $conn) {
  $sql = "SELECT idUtilisateur FROM user
          WHERE idUtilisateur=?  and role ='Module Coordinator'";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$id]);
  
  if ($stmt->rowCount() >= 1) {
     return 0; // ID is not unique
  } else {
     return 1; // ID is unique
  }
}

function unameCoordModuleIsUnique($uname, $conn, $idUtilisateur=0){
   $sql = "SELECT user_name, idUtilisateur FROM user
           WHERE user_name=? and role = 'Module Coordinator' ";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$uname]);
   
   if ($idUtilisateur == 0) {
     if ($stmt->rowCount() >= 1) {
       return 0;
     }else {
      return 1;
     }
   }else {
    if ($stmt->rowCount() >= 1) {
       $Module_Coordinator = $stmt->fetch();
       if ($Module_Coordinator['idUtilisateur'] == $idUtilisateur) {
         return 1;
       }else {
        return 0;
      }
     }else {
      return 1;
     }
   }
   
}

// DELETE
function removeModuleCoord($id, $conn){
   $sql  = "DELETE FROM user
           WHERE role = 'Module Coordinator' and idUtilisateur=?";
   $stmt = $conn->prepare($sql);
   $re   = $stmt->execute([$id]);
   if ($re) {
     return 1;
   }else {
    return 0;
   }
}

// Search 
function searchModuleCoords($key, $conn){
  $key = preg_replace('/(?<!\\\)([%_])/', '\\\$1', $key);

  $sql = "SELECT * FROM user
          WHERE role = 'Module Coordinator' and
          (idUtilisateur LIKE ? 
          OR first_name LIKE ?
          OR last_name LIKE ?
          OR user_name LIKE ?
          OR email LIKE ?
          OR Address LIKE ?
          OR phone_number LIKE ?
          OR date_birth LIKE ?
          OR gender LIKE ?)";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$key, $key, $key, $key, $key, $key, $key, $key, $key]);

  $Module_Coordinators = $stmt->fetchAll();

  if (count($Module_Coordinators) > 0) {
    return $Module_Coordinators;
  } else {
    return 0;
  }
}

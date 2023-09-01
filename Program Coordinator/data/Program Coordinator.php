<?php  

// Get Teacher by ID
function getProgramCoordById($idUtilisateur, $conn){
   $sql = "SELECT * FROM user
           WHERE role = 'Program Coordinator' and idUtilisateur=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$idUtilisateur]);

   if ($stmt->rowCount() == 1) {
    $Program_Coordinator = $stmt->fetch();
     return $Program_Coordinator;
   }else {
    return 0;
   }
}

// All Teachers 
function getAllProgramCoords($conn){
   $sql = "SELECT * FROM user WHERE role = 'Program Coordinator' ";
   $stmt = $conn->prepare($sql);
   $stmt->execute();

   if ($stmt->rowCount() >= 1) {
    $Program_Coordinators = $stmt->fetchAll();
     return $Program_Coordinators ;
   }else {
   	return 0;
   }
}

// Check if the username Unique
function unameIsUnique($uname, $conn, $idUtilisateur=0){
   $sql = "SELECT user_name, idUtilisateur FROM user
           WHERE user_name=?";
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
       $Program_Coordinator = $stmt->fetch();
       if ($Program_Coordinator['idUtilisateur'] == $idUtilisateur) {
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
function removeProgramCoord($id, $conn){
   $sql  = "DELETE FROM user
           WHERE role = 'Program Coordinator' and idUtilisateur=?";
   $stmt = $conn->prepare($sql);
   $re   = $stmt->execute([$id]);
   if ($re) {
     return 1;
   }else {
    return 0;
   }
}

// Search 
function searchProgramCoords($key, $conn){
  $key = preg_replace('/(?<!\\\)([%_])/', '\\\$1', $key);

  $sql = "SELECT * FROM user
          WHERE role = 'Program Coordinator' and
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

function programCoordPasswordVerify($programCoord_pass, $conn, $prof_id){
  $sql = "SELECT * FROM user
          WHERE idUtilisateur=?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$prof_id]);

  if ($stmt->rowCount() == 1) {
    $programCoord = $stmt->fetch();
    $pass  =  $programCoord['password'];
    $pass = password_hash($pass , PASSWORD_DEFAULT);

    if (password_verify($programCoord_pass, $pass)) {
     

      return 1;
    }else {
      return 0;
    }
  }else {
   return 0;
  }
}
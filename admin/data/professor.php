<?php  
// Count the number of professors
function countProfessors($conn){
  $sql = "SELECT COUNT(*) FROM user WHERE role = 'Professor'";
  $stmt = $conn->prepare($sql);
  $stmt->execute();

  $count = $stmt->fetchColumn();

  return $count;
}

// Get Teacher by ID
function getProfessorrById($idUtilisateur, $conn){
   $sql = "SELECT * FROM user
           WHERE role = 'Professor' and idUtilisateur=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$idUtilisateur]);

   if ($stmt->rowCount() == 1) {
    $professor = $stmt->fetch();
     return $professor;
   }else {
    return 0;
   }
}

// All Teachers 
function getAllProfessors($conn){
   $sql = "SELECT * FROM user WHERE role = 'Professor' ";
   $stmt = $conn->prepare($sql);
   $stmt->execute();

   if ($stmt->rowCount() >= 1) {
     $professors = $stmt->fetchAll();
     return $professors;
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
       $professor = $stmt->fetch();
       if ($professor['idUtilisateur'] == $idUtilisateur) {
         return 1;
       }else {
        return 0;
      }
     }else {
      return 1;
     }
   }
   
}

// Check if the ID is Unique
function idprofIsUnique($id, $conn) {
  $sql = "SELECT idUtilisateur FROM user
          WHERE role = 'Professor' and idUtilisateur=? ";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$id]);
  
  if ($stmt->rowCount() >= 1) {
     return 0; // ID is not unique
  } else {
     return 1; // ID is unique
  }
}


// DELETE
function removeProfessor($id, $conn){
   $sql  = "DELETE FROM user
           WHERE role = 'Professor' and idUtilisateur=?";
   $stmt = $conn->prepare($sql);
   $re   = $stmt->execute([$id]);
   if ($re) {
     return 1;
   }else {
    return 0;
   }
}

// Search 
function searchProfessors($key, $conn){
  $key = preg_replace('/(?<!\\\)([%_])/', '\\\$1', $key);

  $sql = "SELECT * FROM user
          WHERE role = 'Professor' and
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

  $professors = $stmt->fetchAll();

  if (count($professors) > 0) {
    return $professors;
  } else {
    return 0;
  }
}

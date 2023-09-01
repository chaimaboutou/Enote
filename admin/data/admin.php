<?php 

function adminPasswordVerify($admin_pass, $conn, $admin_id){
   $sql = "SELECT * FROM user
           WHERE idUtilisateur=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$admin_id]);

   if ($stmt->rowCount() == 1) {
     $admin = $stmt->fetch();
     $pass  = $admin['password'];
     $pass = password_hash($pass , PASSWORD_DEFAULT);

     if (password_verify($admin_pass, $pass)) {
      

     	return 1;
     }else {
     	return 0;
     }
   }else {
    return 0;
   }
}
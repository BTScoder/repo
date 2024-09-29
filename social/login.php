<?php

include("conn/connect.php");

$username = $password = "";
$errors = ["username"=>"","password"=>""];
if(isset($_POST['submit'])){
  //validate username
  if(empty($_POST['username'])){
    $errors['username']  = "This field is empty";
  }
  //validate password
  if(empty($_POST['password'])){
    $errors['password']  = "This field is empty";
  }
  
  if(!array_filter($errors)){
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM Users WHERE Username=?";
    $stmt = mysqli_prepare($conn,$sql);
    
    mysqli_stmt_bind_param($stmt,"s",$username);
    
    mysqli_stmt_execute($stmt);
    
    $result = mysqli_stmt_get_result($stmt);
    
    $identified_user = mysqli_fetch_assoc($result);
    
    if($identified_user){
      if (!empty($identified_user['Password'])){
        //print_r($identified_user);
        if (password_verify($password, $identified_user['Password'])) {
          session_start();
          
          //successful login
          $userId = $identified_user['Id'];
          $user_name = $identified_user['Username'];
          $_SESSION['username'] = $user_name;
          $_SESSION["user_id"] = $userId;
            Header("Location:index.php?id=$userId");
        } else {
            $errors['password']="Invalid password!";
        }
      } else {
        echo "No password stored for this user!";
    }
  } else {
    $errors['username'] = "User doesn't exist!";
  }
}else{
   // print_r($error);
  }
}

?>
<!DOCTYPE html>
<?php  include("templates/header.php") ?>
<div class="container">
    <h3 class="text-center">Social Media- Log In <i class="fa-regular fa-envelope"></i></h3>
    
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
      <div class="container">
        <div class="field">
          <span><i class="fa-solid fa-user"></i></span>
          <input type="text" name="username" placeholder="Enter Username">
        </div>
        <p class="error mt-3 fw-bold"><?php echo $errors['username'] ?></p>
      </div>
      
      <div class="container">
        <div class="field">
          <span><i class="fa-solid fa-lock"></i></span>
          <input type="password" name="password" placeholder="Enter Password">
          <label>
            <input type="checkbox" id="box">
            <span class="custom-check"></span>
          </label>
        </div>
        <p class="error mt-3 fw-bold"><?php echo $errors['password'] ?></p>
      </div>
      <div class="submit text-center">
        <input type="submit" class="submit btn btn-outline-secondary" name="submit">
      </div>
    </form>
    <p class="text-center mt-4">No account? <a href='signup.php'>Sign up</a></p>
  </div>  
</body>
</html>

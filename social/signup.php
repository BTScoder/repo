<?php
session_start();
include("conn/connect.php");
$errors = ['email'=>'','username'=>'','password'=>''];
$email = $username = $password = "";

if(isset($_POST['submit'])){
  
  // validate email
  if(empty($_POST['email'])){
    $errors['email'] = 'You need to fill in this field';
  }else{
    $email = $_POST['email'];
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
      $errors['email'] = 'You need to enter in a valid email';
    }
  }
  
  //validate Username
  if(empty($_POST['username'])){
    $errors['username'] = "You need to fill in this field";
  }else{
    $username = $_POST['username'];
    $sql = "SELECT * FROM Users WHERE Username = ?";
    
    $stmt = mysqli_prepare($conn,$sql);
    
    mysqli_stmt_bind_param($stmt,"s",$username);
    
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    if($row) {
      $errors['username'] = "This username alread exists";
      }
    }
  }
  
  //validate password 
  if(empty($_POST['password'])){
    $errors['password'] = 'You need to fill in this field';
  }else{
      $password = $_POST['password'];
      $pattern ="/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";
      if(!preg_match($pattern,$password)){
        $errors['password'] = "The password must have at least one uppercase letter, one lowercase letter, one number, and one special character.The password must be at least 8 characters long.";
      }
      
  if(!array_filter($errors)){
   // echo " succesful signup";
   $hashed_password = password_hash($password,PASSWORD_DEFAULT);
    $sql = "INSERT INTO Users(Email,Username,Password) VALUES(?,?,?)";
    
    $stmt = mysqli_prepare($conn,$sql);
    
    mysqli_stmt_bind_param($stmt,"sss",$email,$username,$hashed_password);
    
    if(mysqli_stmt_execute($stmt)){
      $_SESSION['username'] = $username;
      Header('Location:index.php');
      exit();
    }
  }else{
   // print_r($errors);
  }
}





?>
<!DOCTYPE html>
<?php include('templates/header.php') ?>
  <div class="container">
    <h3>Social Media- Sign Up <i class="fa-regular fa-envelope"></i></h3>
    
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
      <div class="container">
        <div class="field">
          <span><i class="fa-regular fa-envelope"></i></span>
          <input type="email" name="email" placeholder="Enter Email">
        </div>
        <p class="error mt-3 fw-bold"><?php echo $errors['email'] ?></p>
      </div>
      
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
    <p class="text-center mt-4">Already have an account? <a href='login.php'>Sign up</a></p>
  </div>
  
  
</body>
</html>
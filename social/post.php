<?php 
session_start();
//echo $_SESSION['username'] ?? "Guest";
include('conn/connect.php');
$errors = ['post'=> ''];
if(isset($_POST['submit'])){
  if(empty($_POST['post'])){
    $errors['post'] = "You need to fill in this field";
  }
  
  if(!array_filter($errors)){
    $username = $_SESSION['username'];
    $post = $_POST['post'];
    $sql = "SELECT Id FROM Users WHERE Username = ?";
    $stmt = mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,"s",$username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    $user_id = $row['Id'];
    
    // insert posts into posts table
    $sql = "INSERT INTO Posts(post_author,post,user_id) VALUES(?,?,?)";
    $stmt = mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,"ssi",$username,$post,$user_id);
    if(mysqli_stmt_execute($stmt)){
      echo "Post added succesfully";
      header("Location:index.php");
     // exit();
    }
  }else{
    //print_r($errors);
  }
}









?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/895491e74d.js" crossorigin="anonymous"></script>
  <style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    *{
      margin:0;
      padding:0;
      box-sizing:border-box;
    }
    body{
      font-family: "Poppins", sans-serif;
      background: #eee;
      font-weight: 400;
      font-style:normal;
     /* display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;*/
    }
    .container{
      max-width:400px;
      margin:20px auto;
      text-align: center;
      padding:20px;
    }
    textarea{
      border:none;
      border-bottom:1px solid #ccc;
      background: none;
      border-radius: 25px;
      width:100%;
      outline: none;
      padding:10px;
      box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
    }
    section{
      display: flex;
      align-items: center;
      justify-content: space-around;
      margin-top:45px;
    }
    i{
      font-size:24px;
    }
    a{
      color:black;
    }
  </style>
</head>
<body>
  
      <section>
        <h1 class="my-2">Social Media</h1>
        <nav>
          <a href="index.php"><i class="fa-solid fa-backward me-4"></i></a>
          <a href="logout.php"><i class="fa-solid fa-door-open"></i></a>
        </nav>
      </section>
      <div class="container">
        <?php if($_SESSION['username'] !== 'Guest' && isset($_SESSION['username'])): ?>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method= "POST">
          <textarea name="post" id="post" cols="25" rows="10"></textarea>
          <button class="btn submit mt-3" name="submit"><i class="fa-solid fa-feather-pointed"></i></button>
          </form>
        <?php else: ?>
        <h1>You Cant Access This Page</h1>
        <?php endif; ?>
      </div>

  
</body>
</html>
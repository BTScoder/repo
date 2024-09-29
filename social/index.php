<?php
include("conn/connect.php");
session_start();
$username = $_SESSION['username'] ?? "Guest";

$sql = "SELECT * FROM Posts";

$stmt = mysqli_prepare($conn,$sql);

if(mysqli_stmt_execute($stmt)){
  $result = mysqli_stmt_get_result($stmt);
  $posts = mysqli_fetch_all($result,MYSQLI_ASSOC);
  //print_r($posts);
}else{
  echo "Could not achieve posts".mysqli_error($conn);
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Home Page</title>
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
    /*  font-family: "Poppins-Thin";*/
      font-family: "Poppins", sans-serif;
      background: #eee;
      font-weight: 400;
      font-style:normal;
      
    }
    .container{
      max-width:400px;
      margin:20px auto;
    }
    .post{
      display:grid;
      grid-template-columns: 30px 370px;
      gap:15px;
      
    }
    .image{
      width: 52px;
      height:52px;
      display: flex;
      align-items: center;
      justify-content: center;
      background: white;
      border-radius:50%;
      margin-top:10%;
    }
    .content{
      width:100%;
      padding:15px;
      text-align: left;
      font-size:14px;
    }
    header{
      padding: 20px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    a{
      font-size:24px;
      margin-right: 20px;
      color:black;
    }
    nav{
      display:flex;
      justify-content: space-between;
    }
    .page-two {
      display: flex;
      /*align-items: center;*/
      justify-content: space-between;
      height: 100vh;
      flex-direction: column;
    }

    
    .submit{
      font-size:24px;
    }
    
  </style>
</head>
<body>
      <header>
        <h1>Social Media</h1>
        <nav>
          <a href="post.php" onclick="slide('next')"><i class="fa-solid fa-feather-pointed"></i></a>
          <a href="logout.php"><i class="fa-solid fa-door-open"></i></a>
        </nav>
      </header>
      <div class="container">
        <h3 class="mb-4">Hello <?php echo $username ?></h3>
        <?php foreach($posts as $post): ?>
          <div class="post">
            <div class="image">
              <img src="img/images-1.png" alt="person icon" width="40px" height="40px">
            </div>
            <div class="content">
              <p class="text-secondary">@<?php echo  $post['post_author'] ?></p>
              <?php echo $post['post']; ?>
              <p class="mt-4 text-secondary"><?php echo $post['created_at'] ?></p>
            </div>
          </div><hr>
        <?php endforeach; ?>
        
      </div>
      <?php include('templates/footer.php')  ?>
</body>
</html>

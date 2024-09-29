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
    /*  font-family: "Poppins-Thin";*/
      font-family: "Poppins", sans-serif;
      background: #eee;
      font-weight: 400;
      font-style:normal;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }
    .container{
      background: #ccc;
     /* opacity: 0.7;*/
      max-width: 370px;
      padding:30px;
      border-radius:25px;
    }
    input[type='text'],input[type='email'],input[type='password']{
      display: inline-block;
      padding:10px;
      border:none;
      border-bottom:1px solid black;
      width:100%;
      background: none;
      outline: none;
      transition: 0.3s ease ;
    }
    input:focus {
      padding:16px;
    }
    .field{
      display:flex;
      align-items:center;
    }
    i{
      font-size:19px;
    }
    .check{
      display: flex;
      align-items: center;
      justify-content: center;
    }
    input[type='checkbox']{
      display: none;
    }
    .custom-check {
      width: 20px;
      height: 20px;
      border-radius: 50%;
      background-color: #f1f1f1;
      border: 2px solid #555;
      display: inline-block;
      position: relative;
      cursor: pointer;
    }
    input[type="checkbox"]:checked + .custom-check::after {
      content: '';
      position: absolute;
      left: 3px;
      top: 3px;
      width: 10px;
      height: 10px;
      border: solid #000;
      background: #ccc;
      border-radius: 50%;
     /* border-width: 0 2px 2px 0;*/
      transform: rotate(45deg);
    }
    a{
      color: black;
    }
  </style>
</head>
<body>

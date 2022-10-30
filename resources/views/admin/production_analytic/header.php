<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- link css-->
    
    <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Mukta&family=Rubik&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.1.0/css/dataTables.dateTime.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

  <!--link js-->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="plugins/jszip/jszip.min.js"></script>
    <script src="plugins/pdfmake/pdfmake.min.js"></script>
    <script src="plugins/pdfmake/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.1.0/js/dataTables.dateTime.min.js"></script>
    <script src="plugins/resizer-map/js/imageMapResizer.js"></script>
</head>


<!-- cek login -->
<?php 
  session_start();
  if($_SESSION['status']!="login"){
    header("location:login.php?pesan=belum_login");
  }
  ?>
 
<!-- end cek-->
<style type="text/css">
  body{
    background-color: #F8F9FA;
    font-family: 'Rubik', sans-serif;
    font-size: 14px;
  }
  .bg-card-hope{
    background-color: #595958;
  }
  .bg-card-two{
    background-color: white;
    color: grey;
  }
  .bg-card-efk{
    background-color: ;
  }
  .card-hover{
    background-color: white;
    color: grey;
    text-decoration: none!important;
  }
  .card-hover:hover {
    background-color: F8F9FA;
    color: white;
    text-decoration: none!important;

  }
  .card-hover:hover span{
   display: none;
    
  }
  .card-hover:hover:before {
    content: "Show More";
    text-decoration: none!important;

  }

  th{
    padding-left: 10px;
    text-align: : center;

  }
  tr{
    text-align: : center;
  }
  .bg-ctdas{
    background-color: #F8F9FA;
  }
  .bg-ctdas-2{
    background-color: white;
    color: black;
  }
  .ctdas-t-1{
    font-size: 13px;
    color: black;
  }
  .ctdas-p-1{
    font-size: 18px;
    color: black;
  }
  .ctdas-p-2{
    font-size: 28px;
    color: black;
  }
  .btn-ctdas{
    background-color: #394253;
    color: grey;
  }
  
</style>

<!-- Navbar -->
<nav class="navbar navbar-expand-xl navbar-light bg-white border-bottom py-3">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php"><img src="assets/img/logo/text-pm.png" alt="" height="40"></a>
    

    <div>
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">        
      </ul>
      <div class="d-block d-sm-block d-lg-none">
         <ul class="navbar-nav flex-row ps-5">
          <li class="nav-item me-3 me-lg-1">
            <a class="nav-link d-sm-flex align-items-sm-center" href="#">
              <i class="fas fa-user-circle fa-lg"></i>
              <strong class="d-none d-sm-block ms-2">John</strong>
            </a>
          </li>
          
          <li class="nav-item dropdown me-3 me-lg-1">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fas fa-bell fa-lg"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">Some news</a></li>
              <li><a class="dropdown-item" href="#">Another news</a></li>
              <li>
                <a class="dropdown-item" href="#">Something else here</a>
              </li>
            </ul>
          </li>
         
          <li class="nav-item dropdown me-3 me-lg-1">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fas fa-cog fa-lg"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">Some news</a></li>
              <li><a class="dropdown-item" href="#">Another news</a></li>
              <li>
                <a class="dropdown-item" href="#">Something else here</a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
      <!-- Right elements -->
      <div class="d-none d-sm-none d-lg-block">
         <ul class="navbar-nav flex-row ps-5">
          <li class="nav-item me-3 me-lg-1">
              <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit"><i class="fas fa-search"></i></button>
              </form>
          </li>
          <li class="nav-item me-3 me-lg-1">
            <a class="nav-link d-sm-flex align-items-sm-center" href="#">
              <i class="fas fa-user-circle fa-lg"></i>
              <strong class="d-none d-sm-block ms-2">John</strong>
            </a>
          </li>
          
          <li class="nav-item dropdown me-3 me-lg-1">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fas fa-bell fa-lg"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">Some news</a></li>
              <li><a class="dropdown-item" href="#">Another news</a></li>
              <li>
                <a class="dropdown-item" href="#">Something else here</a>
              </li>
            </ul>
          </li>
         
          <li class="nav-item dropdown me-3 me-lg-1">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fas fa-cog fa-lg"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">Change Password</a></li>
              
              <li>
                <a class="dropdown-item" href="logout.php">Logout</a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
   
    </div>

  </div>
</nav>
<!-- Navbar -->



  







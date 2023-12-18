<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>TMCFI Student Profile</title>


  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!-- font awesome style -->
  <link href="css/font-awesome.min.css" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />

</head>

<body class="sub_page">

  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="">
            <span>
            TMCFI Student Profile
            </span>
          </a>

         
          <!--
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""> </span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav  ">
              <li class="nav-item ">
                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="login.php">Log In</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="about.html"> About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="visit.html">Visit Us</a>
              </li>
            </ul>
-->
            <div class="logout">
              <a href="logout.php" class="quote_btn">
                Log Out
              </a>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->
  </div>

  <!-- service section -->
  <section class="service_section layout_padding">

  <div class="tabledb">

  <?php
include "database.php";

if (isset($_POST['update'])) {
  $stu_id = $_POST['stu_id'];
  $first_name = $_POST['first'];
  $last_name = $_POST['last'];
  $year = $_POST['year'];
  $snum = $_POST['snumber'];
  $course = $_POST['course'];
  $bday = date('Y-m-d', strtotime($_POST['bday'])); // Format the date correctly

  // Use prepared statement to prevent SQL injection
  $sql = "UPDATE student SET `First Name`=?, `Last Name`=?, `Year`=?, `Student No.`=?, `Course`=?, `Bday`=? WHERE id=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssisssi", $first_name, $last_name, $year, $snum, $course, $bday, $stu_id);

  if ($stmt->execute()) {
      echo "Record updated successfully.";
      header('Location: home.php');
  } else {
      echo "Error updating record: " . $stmt->error;
  }

  $stmt->close();
}


if (isset($_GET['id'])) {
    $stu_id = $_GET['id'];
    $sql = "SELECT * FROM student WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $stu_id);
    $stmt->execute();
    
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $first = $row['First Name'];
            $last = $row['Last Name'];
            $year = $row['Year'];
            $snum = $row["Student No."];
            $course = $row["Course"];
            $bday = $row["Bday"];
        }
    }
    
    $stmt->close();
}
?>

  
    <form action="" method="post">

        <h1> Add Student Information </h1>

        <div class="input-box">
        <label for="firs"> First Name </label>
        <input type="text" id="firs" name="first" value="<?php echo $first; ?>">
        <input type="hidden" name="stu_id" value="<?php echo $id; ?>">
        </div>


        <div class="input-box">
        <label for="las"> Last Name</label>
        <input type="text" id="las" name="last" value="<?php echo $last; ?>">
        </div>

        <div class="input-box">
        <label for="yea"> Year</label>
        <input type="text" id="yea" name="year" value="<?php echo $year; ?>">
        </div>

        <div class="input-box">
        <label for="sno"> Student No. </label>
        <input type="text" id="sno" name="snumber" value="<?php echo $snum; ?>">
        </div>

        <div class="input-box">
    <label for="cou"> Course </label>
    <select id="cou" name="course">
        <option <?php echo ($course == 'BEED') ? 'selected' : ''; ?>>BEED</option>
        <option <?php echo ($course == 'BSCrim') ? 'selected' : ''; ?>>BSCrim</option>
        <option <?php echo ($course == 'BSHM') ? 'selected' : ''; ?>>BSHM</option>
        <option <?php echo ($course == 'BSIT') ? 'selected' : ''; ?>>BSIT</option>
        <option <?php echo ($course == 'BSCS') ? 'selected' : ''; ?>>BSCS</option>
    </select>
</div>


        <div class="input-box">
        <label for="bda"> Birthday </label>
        <input type="date" id="bda" name="bday" value="<?php echo $bday; ?>">
        </div>

        <input type="submit" class="btn-1" name="update" value="Change">

    </form>
  </div>  

  </section>
  <!-- end service section -->


  <div class="footer_container">
    <!-- info section -->

    <section class="info_section ">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-lg-3 ">
            <div class="info_detail">
              <h4>
              TMCFI Student Profile
              </h4>
              <p>
                We, the BSCS-3 students are contributing to our school by creating a
                student profile, where can create, manipulate and
                store student information for educational purposes.
              </p>
            </div>
          </div>
          <div class="col-md-6 col-lg-2 mx-auto">
            <div class="info_link_box">
              <h4>
                Links
              </h4>
              <div class="info_links">
                <a class="" href="">
                  Home
                </a>
                <a class="" href="">
                  About
                </a>
                <a class="" href="">
                  Log In
                </a>
                <a class="" href="">
                  Contact Us
                </a>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 ">
            <h4>
              Subscribe
            </h4>
            <form action="#">
              <input type="text" placeholder="Enter email" />
              <button type="submit">
                Subscribe
              </button>
            </form>
          </div>
          <div class="col-md-6 col-lg-3 mb-0 ml-auto">
            <div class="info_contact">
              <h4>
                Address
              </h4>
              <div class="contact_link_box">
                <a href="">
                  <i class="fa fa-map-marker" aria-hidden="true"></i>
                  <span>
                    Brgy. Poblacion Norte, San Isidro, Northern Samar
                  </span>
                </a>
                <a href="">
                  <i class="fa fa-phone" aria-hidden="true"></i>
                  <span>
                    Call +01 1234567890
                  </span>
                </a>
                <a href="https://www.facebook.com/pages/Tan%20Ting%20Bing%20Memorial%20Colleges%20Foundation%20Inc./120570057986566/">
                  <i class="fa fa-facebook" aria-hidden="true"></i>
                  <span>
                    TMCFI
                  </span>
                </a>
              </div>
            </div>
            <div class="info_social">

              
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- end info section -->

    <!-- footer section -->
    <footer class="footer_section">
      <div class="container">
        <p>
          &copy; <span id="displayYear"></span> All Rights Reserved 
        </p>
      </div>
    </footer>
    <!-- footer section -->
  </div>

  <!-- jQery -->
  <script src="js/jquery-3.4.1.min.js"></script>
  <!-- popper js -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <!-- bootstrap js -->
  <script src="js/bootstrap.js"></script>
  <script src="js/custom.js"></script>
  <!-- Google Map -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap"></script>
  <!-- End Google Map -->

</body>

</html>
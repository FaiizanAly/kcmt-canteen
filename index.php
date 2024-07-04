<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
error_reporting(0);
session_start();
?>
<head>
  <meta charset="utf-8">
  <title>KCMT Canteen - Food Ordering & Management</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">
  <!-- aos library -->
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
  <!-- Google Web Fonts  -->
  <!-- <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> -->
  <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap" rel="stylesheet">
  <!-- Icon Font Stylesheet -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
  <!-- Bootstrap Stylesheet -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!-- jquery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <!-- External Css -->
  <link rel="stylesheet" href="style.css">
  <script src="in.js"></script>
</head>
<body data-spy="scroll" data-target="navscroll" data-offset="0">
  <!-- /////////////////////////navbar//////////////////////////////////////// -->
  <header>
    <div class="container-xxl position-relative p-0">
      <nav class="navbar navbar-expand-lg  navbar-dark px-4 px-lg-5 " id="navscroll">
        <a href="" class="navbar-brand p-0 ">
          <h1 class=" m-0"><i class="fa fa-utensils me-3"></i>KCMT Canteen</h1>
        </a>
        <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
          <span class="navbar-toggler-icon"></span>
        </button>
        <!-- nav div -->
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <div class="navbar-nav ms-auto py-0 pe-4 justify-content-center">
            <a href="index.php" class="nav-item nav-link active">Home</a>
            <a href="#about" class="nav-item nav-link  ">ABOUT</a>
            <?php
            if (empty($_SESSION["user_id"])) // if user is not login
            {
              echo ' <a href="#menu" class="nav-item nav-link ">MENU</a>';
            } else {
              echo ' <a href="menu.php" class="nav-item nav-link ">MENU</a>';
            }
            ?>
            <a href="#service" class="nav-item nav-link ">SERVICES</a>
            <a href="#contact" class="nav-item nav-link ">CONTACT US</a>
          </div>
          <!-- btn -->
          <?php
          if (empty($_SESSION["user_id"])) // if user is not login
          {
            echo '<a href="registration.php" class="btnnn  py-2 px-4">REGISTER</a>
                <a href="login.php" class="btnnn  py-2 px-4 mx-lg-3 my-2">LOGIN</a>';
          } else {
            echo '<a href="your_orders.php" class="btnnn  py-2 px-4">My Order</a>
            <a href="logout.php" class="btnnn  py-2 px-4 mx-lg-3 my-2">LogOut</a>';
          }
          ?>
        </div>
      </nav>
    </div>
  </header>
  <!-- ////////////////////////////////////////////carousel/////////////////////////////////// -->
  <main>
    <article>
      <section>
        <div id="carouselExampleControls" class="carousel slide carousel-fade" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="7000">
              <img src="img/hero-slider-1.jpg" class="d-block w-100 " alt="...">
              <div class="carousel-caption d-md-block ">
                <p class="carose">Traditional & Hygine</p>
                <h1 class="carose">For The Love Of <br>Delicious Food</h1>
                <a href="#menu" class="btnnncaro py-3 px-5 my-3 carose">View Menu</a>
              </div>
            </div>
            <div class="carousel-item" data-bs-interval="7000s">
              <img src="img/hero-slider-2.jpg" class="d-block w-100" alt="...">
              <div class="carousel-caption  d-md-block ">
                <p class="carose">Traditional & Hygine</p>
                <h1 class="carose">Enjoy Our<br>Delicious Food</h1>
                <a href="#menu" class="btnnncaro py-3 px-5 carose">View Menu</a>
              </div>
            </div>
            <div class="carousel-item" data-bs-interval="7000">
              <img src="img/slider1.jpg" class="d-block w-100 carose-img" alt="...">
              <div class="carousel-caption d-md-block ">
                <p class="carose">Traditional & Hygine</p>
                <h1 class="carose">Indulge In The <br>Deliciousness</h1>
                <a href="#menu" class="btnnncaro py-3 px-5  carose">View Menu</a>
              </div>
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </section>
      <!--**********************************service********************************* -->
      <section class="service" id="service">
        <div class="servicesection ">
          <div class="servicecon container-xxl text-center ">
            <p class="service">Our Services</p>
            <h2 class="service">Explore Our Delicious Offerings</h2>
            <p class="text service">Discover our wide range of <br> culinary delights, from hearty breakfast options to
              <br>mouthwatering snacks.
            </p>
            <figure class="figure fig1 ">
              <img src="img/service1.jpg" class="figure-img img-fluid rounded" alt="..." data-aos="flip-left">
              <figcaption class="figure-caption text-center">
                <h3>Lovely Breakfast </h3>
                <a class="figviewmenu" href="#menu">VIEW MENU</a>
              </figcaption>
            </figure>
            <figure class="figure fig2  ">
              <img src="img/service2.jpeg" class="figure-img img-fluid rounded" alt="..." data-aos="flip-down">
              <figcaption class="figure-caption text-center">
                <h3>Special Lunch</h3>
                <a class="figviewmenu" href="#menu">VIEW MENU</a>
              </figcaption>
            </figure>
            <figure class="figure fig3 ">
              <img src="img/service3.jpg" class="figure-img img-fluid rounded" alt="..." data-aos="flip-right">
              <figcaption class="figure-caption text-center">
                <h3>Tasty Snacks</h3>
                <a class="figviewmenu" href="#menu">VIEW MENU</a>
              </figcaption>
            </figure>
          </div>
        </div>
      </section>
      <!-- ********************************************about us**************************************************** -->
      <section class="about" id="about">
        <div class="container-xxl py-5" id="#about">
          <div class="container">
            <div class="row g-5 align-items-center">
              <div class="col-lg-6">
                <div class="row g-3">
                  <div class="col-6 text-start">
                    <img class="img-fluid rounded w-100 aboutimg " style="animation-delay: 0.1s;" src="img/about4.jpg" data-aos="zoom-in">
                  </div>
                  <div class="col-6 text-start">
                    <img class="img-fluid rounded w-75 aboutimg " src="img/about2.jpg" style="margin-top: 25%; animation-delay: 0.3s;" data-aos="fade-left">
                  </div>
                  <div class="col-6 text-end">
                    <img class="img-fluid rounded w-75 aboutimg " style="animation-delay: 0.5s;" src="img/about3.jpg" data-aos="fade-right">
                  </div>
                  <div class="col-6 text-end">
                    <img class="img-fluid rounded w-100 aboutimg " style="animation-delay: 0.1s;" src="img/about1.jpg" data-aos="zoom-in">
                  </div>
                </div>
              </div>
              <div class="col-lg-6  aria-hidden" data-aos="slide-up">
                <h5 class="section-title ff-secondary text-start fw-normal">About Us</h5>
                <h1 class="mb-4">Welcome To <i class="fa fa-utensils  me-2"></i>Canteen</h1>
                <p class="mb-4">Our college canteen is a vibrant hub where students gather to enjoy delicious meals and unwind between classes.</p>
                <p class="mb-4">We offer a wide variety of options, from freshly prepared sandwiches and salads to hot meals and snacks, ensuring that students have access to nutritious and affordable food throughout the day. <br>
                We take pride in maintaining the highest standards of hygiene and quality.</p>
                <div class="row g-4 mb-4">
                  <div class="col-sm-6">
                    <div class="d-flex align-items-center border-start border-5  px-3">
                      <h1 class="flex-shrink-0 display-5  mb-0" data-toggle="counter-up">15</h1>
                      <div class="ps-4">
                        <p class="mb-0">Years of</p>
                        <h6 class="text-uppercase mb-0">Experience</h6>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="d-flex align-items-center border-start border-5  px-3">
                      <h1 class="flex-shrink-0 display-5 mb-0" data-toggle="counter-up">50</h1>
                      <div class="ps-4">
                        <p class="mb-0">Tastefull</p>
                        <h6 class="text-uppercase mb-0">Menu option</h6>
                      </div>
                    </div>
                  </div>
                </div>
                <a class="btnnncaro py-3 px-5 mt-5 animated fadeInUp" href="">Read More</a>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- ************************************menu********************************************** -->
      <section class="menu" id="menu">
        <div class="container">
          <h1 class="text-center py-4">Explore our menu</h1>
          <div class="container-xxl">
            <div class="row align-items-stretch justify-content-center my-5">
              <?php
              $select_products = mysqli_query($db, "SELECT * FROM dishes limit 9");
              while ($fetch_product = mysqli_fetch_assoc($select_products)) {
              ?>
                <div class="col-md-4 mb-5 " data-aos="zoom-in-up">
                  <div class="card w-100">
                    <img class="card-img-top" src="admin/Res_img/dishes/<?php echo $fetch_product['img']; ?>" alt="<?php echo $fetch_product['name']; ?>">
                    <div class="card-body">
                      <h2 class="card-title text-center"><?php echo $fetch_product['name']; ?></h2>
                      <h3 class="card-title text-center"><?php echo $fetch_product['slogan']; ?></h3>
                      <div class="content d-flex justify-content-around align-items-center">
                        <h2 class="text-bold"><i class="fas fa-rupee-sign mt-1"><?php echo $fetch_product['price']; ?>/-</i>
                        </h2>
                        <?php
                        if (empty($_SESSION["user_id"])) // if user is not login
                        {
                          echo '<a href="login.php" class="btn menubutton ">Explore</a>';
                        } else {
                          echo '<a href="menu.php" class="btn menubutton">Explore</a>';
                        }
                        ?>
                      </div>
                    </div>
                  </div>
                </div>
                </form>
              <?php
              }
              ?>
            </div>
          </div>
      </section>
      </div>
    </article>
  </main>
  <?php include './footer.php'; ?>
  <!-- JavaScript Libraries -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <!-- aos script -->
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
</body>
</html>
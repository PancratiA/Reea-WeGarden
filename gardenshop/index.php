<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="mystyle.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">

   
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
<body>

<div class="sticky"> <i>WeGarden</i>  <br>
    <a class="contact" href="#contact">Contact : +40 746 099 123   </a>
</div>

<ul class="sticky">
     <li class="sticky active"><a href="index.php">Home</a></li>
     <li class="sticky"><a href="#about">About us</a></li>
     <li class="sticky"><a href="services.php">Services</a></li>
     <?php
session_start(); 

if (isset($_SESSION['user_id'])) {
    $session_active = true;
} else {
    $session_active = false;
}
?>
<?php if ($session_active): ?>
         <li class="basket"><a href="logout.php"><i>Log Out</i></a></li>
     <?php endif; ?>

     <li class="basket"><a href="basket.php"><i  class="fa">&#xf291;</i></a></li>
     

</ul>
<section>
<div class="slideshow-container">

    <div class="mySlides fade">
      <img class="slideshow "src="images/slideshow1.jpg" style="width:100%">
      <div class="text">Here at <b> WeGarden</b> we want <i> you </i> to be satisfied</div>
    </div>
    
    <div class="mySlides fade">
      <img  class="slideshow "src="images/slideshow2.jpg" style="width:100%">
      <div class="text">Here at <b> WeGarden</b> we want <i> you </i> to be satisfied</div>
    </div>
    
    <div class="mySlides fade">
      <img class="slideshow " src="images/slideshow3.jpg" style="width:100%">
      <div class="text">Here at <b> WeGarden</b> we want <i> you </i> to be satisfied</div>
    </div>
    
    </div>
    <br>
    
    <div style="text-align:center">
      <span class="dot"></span> 
      <span class="dot"></span> 
      <span class="dot"></span> 
    </div>
</section>
    <script>
        let slideIndex = 0;
        showSlides();
        
        function showSlides() {
          let i;
          let slides = document.getElementsByClassName("mySlides");
          let dots = document.getElementsByClassName("dot");
          for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";  
          }
          slideIndex++;
          if (slideIndex > slides.length) {slideIndex = 1}    
          for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
          }
          slides[slideIndex-1].style.display = "block";  
          dots[slideIndex-1].className += " active";
          setTimeout(showSlides, 3000); 
        }
        </script>
        


        <section  class="about">
   <P></P> <h2 id="about">About Us</h2>
    <p>Welcome to WeGarden, your premier destination for effortless gardening services. Whether you're looking to trim hedges, mow lawns, or revamp your outdoor space, we've got you covered. At WeGarden, we understand that maintaining a beautiful garden can be time-consuming and challenging. That's why we've simplified the process with easy online scheduling and reliable service providers.</p>
    <p>Our team of experienced gardeners is dedicated to enhancing your outdoor environment. From routine maintenance to special projects, each service is tailored to meet your unique needs. We take pride in delivering exceptional results, ensuring your garden looks its best year-round.</p>
    <p>Discover the convenience of professional gardening services at your fingertips. Join the growing community of satisfied customers who trust WeGarden for all their landscaping needs. Let us transform your outdoor space into a flourishing oasis – because your garden deserves the best.</p>
    <p>Experience the difference with WeGarden. Schedule your service today and see why we're the preferred choice for gardening enthusiasts everywhere.</p>
</section>

<section>
        <h2 style="color:#253833">Our Crew</h2>
       <p style="text-align:center;font-size: 20px;"> <img src="images/gardeners.jpg" style="float:left; width:500px;height:300px;">Although quite a small crew We are a team of <b> 6 </b> outdoor-passionate individuals that will get it done no matter what!</p>
       
    </section>
    
        <section>
        <div id="contact" class="contact-section">
    <h2>Contact</h2>
    <p><i class="fa fa-phone"></i> <a href="tel:074-609-0123" > +40 746 099 123</a></p>
    <p><i class="fa fa-envelope"></i> <a href="mailto:contact@WeGarden.com" > contact@WeGarden.com</a></p>
    <p><i class="fa fa-facebook"></i> <a href="https://facebook.com/WeGarden">WeGarden</a></p>
    </div>
    <section>
   


    



</body>
</html>
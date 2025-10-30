<?php include 'header.php'; ?>




<div id="content" class="hidden">
  <!-- Navbar -->
  <?php include "nav.php" ?>

  <!-- Hero Section -->

  <?php include_once 'slider.php'; ?>

  <?php
  if (empty($_SESSION['login_success'])) {
    include_once 'coaching_form.php';
  }
  ?>

  <!-- destination section -->
  <?php include "destination.php" ?>

  <!-- cousrse section -->
  <?php include "trending_course.php" ?>

  <!-- subject section -->
  <?php include "subject_section.php" ?>

  <!-- university partner section -->
  <?php include "university_partners.php" ?>

  <!-- testamonial section -->
  <?php include "testimonials_section.php" ?>

  <!-- faq section -->
  <?php include "faq_section.php" ?>

  <!-- contact us form section -->
  <?php include "contactus_form.php" ?>

  <!-- footer -->
  <?php include "footer.php" ?>



</div>


</body>

</html>
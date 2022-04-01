<?php
if (date("Y") == $date_creation and $statut == 1) {
?>
  <footer class="footer footer-static footer-dark">
    <p class="clearfix mb-0">
      <span class="float-left d-inline-block"><?php echo date("Y") ?> &copy; </span>
      <span class="float-right d-sm-inline-block d-none">
        <a class="text-uppercase" href="mailto:devcarle@gmail.com" target="_blank">
          <h1>NEED UPDATES.. CONTACT ADMINISTRATOR</h1>
        </a>
      </span>
      <span class="float-right d-sm-inline-block d-none">
        <a class="text-uppercase" href="https://s.htr.cm/KH4d" onclick="alert('You will be redirected to the donation page..thanks')" target="_blank">
          <h1>Or make donation and continue your work</h1>
        </a>
      </span>

      <button class="btn btn-primary btn-icon scroll-top" type="button"><i class="bx bx-up-arrow-alt"></i></button>
    </p>
  </footer>
<?php
  exit();
  // code...
}
?>
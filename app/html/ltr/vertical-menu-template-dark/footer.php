<?php
if (date("Y") == $date_creation + 1) {
?>
  <footer class="footer footer-static footer-dark">
    <p class="clearfix mb-0">
      <span class="float-left d-inline-block"><?php echo date("Y") ?> &copy; </span>
      <span class="float-right d-sm-inline-block d-none">
        <a class="text-uppercase" onclick="alert('Mailing.. \n You are going to send a mail to the administrator')"  href="mailto:devcarle@gmail.com" target="_blank">
          <h1>NEED UPDATES.. CONTACT ADMINISTRATOR</h1>
        </a>
      </span>
      <span class="float-right d-sm-inline-block d-none">
        <a class="text-uppercase" onclick="alert('Redirection..\n you are going to be redirected to Mesomb to achieve your Donation after you will automatically bring back here.')" href="https://s.htr.cm/KH4d" onclick="alert('You will be redirected to the donation page..thanks')" target="_blank">
          <h1>CLick-> make donation and continue your work</h1>
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
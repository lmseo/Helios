<?php
$out.='<a class="anchor" id="contact"></a><section class="contact">
  <form action="/contact/" autocomplete="on" method="post">
  <div class="row">
  <div class="large-12 columns">
   <h1 class="contact-title">Contact Us</h1>
   <hr>
   </div>
    <div class="large-6 columns">
      <label>First Name
        <input type="text" placeholder="First Name">
      </label>
    </div>
    <div class="large-6 columns">
      <label>Last Name
        <input type="text" placeholder="Last Name">
      </label>
    </div>
  </div>
  <div class="row">
    <div class="large-6 columns">
      <label>Email
        <input type="text" placeholder="example@email.com">
      </label>
    </div>
    <div class="large-6 columns">
      <div class="row collapse">
        <label>Phone Number</label>
          <input type="text" placeholder="xxx-xxx-xxxx">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="large-6 columns">
      <label>Your Message
        <textarea placeholder="Your Message" rows="7"></textarea>
      </label>
    </div>
  </div>
   <div class="row">
    <div class="large-12 columns">
         <input type="submit" value="Submit" class="home-button home-contact-submit">
    </div>
  </div>
</form></section>';
?>
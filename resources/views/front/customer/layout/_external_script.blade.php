<div id="myModal" class="djmodal">
    <!-- Modal content -->
    <div class="djmodal-content">
        <div class="modal-header bg-success">
          <h5 class="modal-title" id="exampleModalLabel">Send Message @ WhatsApp</h5>
            <span aria-hidden="true" class="djclose">&times;</span>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Recipient:</label>
              <input type="text" class="form-control" id="recipient-name">
            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">Message:</label>
              <textarea class="form-control" id="message-text"></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success">Send message</button>
        </div>
      </div>
    </div>
  
  </div>
<!-- bundle -->
 <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
 <script src="{{ asset('assets/js/app.min.js') }}"></script>
 <!-- bundle -->
<!-- end demo js-->
<script src="{{ asset('assets/custom/js/effect.js') }}"></script>

  <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

  <script>
    $('.nav-link.nav-user').mouseenter(function() {
      $(this).addClass('show');
      $(this).attr('aria-expanded', true);
      $('.profile-dropdown').addClass('show');
      $('.profile-dropdown').attr('data-bs-popper', 'none');
    })

    $('.nav-link.nav-user').mouseleave( function(e) {

      if( ! $(e.toElement).hasClass('profile-dropdown') ) {
        $(this).removeClass('show');
        $(this).attr('aria-expanded', false);
        $('.profile-dropdown').removeClass('show');
      } else {
          
      }
       
    });

    function goToProfile() {
      window.location.href="{{ route('profile') }}";
    }

    var modal = document.getElementById("myModal");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("djclose")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
      modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }

    function sendWhatsappApiSms() {
      modal.style.display = "block";
    }

    function getCustomerTab(ident) {
      var tab_name = $(ident).data('id');
      

    }

</script>
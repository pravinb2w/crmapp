 <!-- bundle -->
 <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
 <script src="{{ asset('assets/js/app.min.js') }}"></script>
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
</script>
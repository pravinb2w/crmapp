<!DOCTYPE html>
<html lang="en">
    @include('front.customer.layout.header')
    <style>
        
/* The Modal (background) */
.djmodal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.djmodal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  border: 1px solid #888;
  width: 40%;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
  -webkit-animation-name: animatetop;
  -webkit-animation-duration: 0.4s;
  animation-name: animatetop;
  animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
  from {top:-300px; opacity:0} 
  to {top:0; opacity:1}
}

@keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
}

/* The Close Button */
.djclose {
  color: white;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.djclose:hover,
.djclose:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.djmodal-header {
  padding: 2px 16px;
  background-color: #5cb85c;
  color: white;
}

.djmodal-body {padding: 2px 16px;}

.djmodal-footer {
  padding: 2px 16px;
  background-color: #5cb85c;
  color: white;
}
    </style>
    <body class="loading" data-layout-config='{"darkMode":false}'>
        @include('front.customer.layout.navbar')
        @yield('content')
        @if( isset( $not_home ) && $not_home != 'auth')
            @include('front.customer.layout.footer')
        @endif
        @include('front.customer.layout.scripts')
        
    </body>
</html>

<section class="py-5" id="about-us">
    <div class="container"> 
        @php
            
        @endphp
        @if( $payment_error == 'success')
        <div class="row pb-3 pt-3 align-items-center bg-success">
            <div class="col-lg-12 col-md-12">
                <div class=" text-center">
                    <h2 class="text-white mb-2 w-100 aos-init"data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="1200">
                       Your order Payment Successfully done
                    </h2>
                    <p class="w-100 text-center text-white">
                        Order No: {{ $payment_order_no ?? 'N/A' }}
                    </p>
                    <a class="btn btn-primary btn-sm" target="_blank" href="{{ asset('invoice').'/'. str_replace("/", "_", $payment_invoice_no ?? '') . '.pdf' }}">Download Invoice</a>
                </div>
            </div>
        </div> 
        @endif
        @if( $payment_error == 'error')
        <div class="row pb-3 pt-3 align-items-center bg-danger">
            <div class="col-lg-12 col-md-12">
                <div class=" text-center">
                    <h2 class="text-white mb-2 w-100 aos-init"data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="1200">
                       Your order Payment has Failed
                    </h2>
                    <p class="w-100 text-center text-white">
                        Order No: {{ $payment_order_no ?? 'N/A' }}
                    </p>

                </div>
            </div>
        </div> 
        @endif
    </div>
</section>
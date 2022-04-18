<div class="col-12">
    
    <div class="row mt-2">
        <div class="col-3">
            <label for=""> Cash <span class="text-danger">*</span></label>
            <input type="text" name="amount" id="amount" class="form-control price" required>
        </div>
        <div class="col-3">
            <label for=""> Payment Method <span class="text-danger">*</span></label>
            <select name="payment_method" id="payment_method" class="form-control" required>
                <option value="">--select--</option>
                @if( config('constant.role_menu') )
                    @foreach( config('constant.payment_method') as $item)
                        <option value="{{ $item }}"> {{ strtoupper($item) }}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="col-3">
            <label for=""> Payment Status <span class="text-danger">*</span></label>
            <select name="payment_status" id="payment_status" class="form-control" required>
                <option value="">--select--</option>
                @if( config('constant.role_menu') )
                    @foreach( config('constant.payment_status') as $item)
                        <option value="{{ $item }}"> {{ strtoupper($item) }}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
    <div class="row mt-2" id="change-row" >
        <div class="col-sm-3" id="ref_show">
            <label for="reference_no"> ReferenceNo  <span class="text-danger">*</span></label>
            
            <input type="text" name="reference_no" id="reference_no" class="form-control" required>
            <small class="text-muted">( Card/Upi/Cheque/Transaction No )</small>
        </div>
        <div class="col-sm-3" id="cheque_show">
            <label for="cheque_date"> Cheque Date <span class="text-danger">*</span> </label>
            <input type="date" name="cheque_date" id="cheque_date" class="form-control" required>
        </div>
    </div>
</div>

<script>
$('#ref_show').hide();
$('#cheque_show').hide();
$( '#payment_method' ).change(function(){
    var curr = $(this).val();
    if( curr != 'cash') {
        $('#ref_show').show();
        $('#reference_no').attr('required', true);

        if( curr == 'cheque') {
            $('#cheque_date').attr('required', true);
            $('#cheque_show').show();
        } else {
            $('#cheque_date').attr('required', false);
            $('#cheque_show').hide();
        }
        
    } else {
        $('#reference_no').attr('required', false);
        $('#cheque_date').attr('required', false);
        $('#ref_show').hide();
        $('#cheque_show').hide();
    }
}); 




</script>
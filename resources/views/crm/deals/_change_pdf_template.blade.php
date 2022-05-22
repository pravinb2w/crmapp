<div class="modal-dialog modal-xl">
    <form  id="dealstage-form" method="POST" action="{{ route('dealstages.save') }}" autocomplete="off" class="modal-content h-100">
        <div class="modal-header">
            <h4 class="modal-title" id="myLargeModalLabel">{{ $modal_title }}</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-3" >
            <div class="row">
                <div class="col-12" id="error">
                </div>
                <div class="col-md-3">
                    <div class="card border shadow-sm">
                        <div class="card-header bg-light">
                            <input required type="radio" style="transform: scale(1.5)" value="type_1" name="type" class="me-2 form-check-input" id="type_1">
                            <label  for="type_1"><b>Default Info Invoice</b></label>
                        </div>
                        <div class="card-body text-center">
                            <img src="{{ asset('assets/images/invoice.png') }}" class="mx-auto border" style="height: 300px;object-fit:cover">
                        </div> 
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border shadow-sm">
                        <div class="card-header bg-light">
                            <input required type="radio" style="transform: scale(1.5)" value="type_1" name="type" class="me-2 form-check-input" id="type_1">
                            <label  for="type_1"><b>Basic Info Invoice</b></label>
                        </div>
                        <div class="card-body text-center">
                            <img src="{{ asset('assets/images/invoice.png') }}" class="mx-auto border" style="height: 300px;object-fit:cover">
                        </div> 
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border shadow-sm">
                        <div class="card-header bg-light">
                            <input required type="radio" style="transform: scale(1.5)" value="type_2" name="type" class="me-2 form-check-input" id="type_2">
                            <label for="type_2"><b>Standard Invoice</b></label>
                        </div>
                        <div class="card-body text-center">
                            <img src="https://www.deskera.com/blog/content/images/2020/12/Commercial_Invoice--1-.png" class="mx-auto border" style="height: 300px;object-fit:cover">
                        </div> 
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border shadow-sm">
                        <div class="card-header bg-light">
                            <input required type="radio" style="transform: scale(1.5)" value="type_3" name="type" class="me-2 form-check-input" id="type_3">
                            <label for="type_3"><b>Info Invoice</b></label>
                        </div>
                        <div class="card-body text-center">
                            <img src="https://www.zoho.com/invoice/what-is-invoice/commercial-invoice.png" class="mx-auto border" style="height: 300px;object-fit:cover">
                        </div> 
                    </div>
                </div>
            </div> 
        </div>
        <div class="modal-footer">
            <div class="col-12 text-end">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal" aria-label="Close"> Cancel</button>
                <button type="submit" class="btn btn-info" id="save">Continue</button>
            </div>
        </div>
    </form><!-- /.modal-content -->
</div>

<script>
       

        
</script>
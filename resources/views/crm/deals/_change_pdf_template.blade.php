<div class="modal-dialog modal-xl">
    <form  id="layout-form" method="POST" autocomplete="off" class="modal-content h-100">
        <div class="modal-header">
            <h4 class="modal-title" id="myLargeModalLabel">{{ $modal_title }}</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-3" >
            <div class="row">
                <div class="col-12" id="error">
                </div>
                <style>
                    [type=radio] { 
  position: absolute;
  opacity: 0;
  width: 0;
  height: 0;
}

/* IMAGE STYLES */
[type=radio] + img {
  cursor: pointer;
}

/* CHECKED STYLES */
[type=radio]:checked + img {
  outline: 3px solid rgb(113, 224, 113);
}
                </style>
                <div class="col-md-3">
                    <div class="card border shadow-sm">
                        <div class="card-header bg-light">
                            <label  for="default"><b>Default Info Invoice</b></label>
                        </div>
                        <div class="card-body text-center">
                            <label>
                                <input type="radio" name="layout_type" value="default" checked>
                                <img src="{{ asset('assets/images/logo/default-layout.jpg') }}" class="mx-auto border" style="height: 300px;object-fit:cover">
                              </label>
                        </div> 
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border shadow-sm">
                        <div class="card-header bg-light">
                            <label  for="two"><b>Layout Two</b></label>
                        </div>
                        <div class="card-body text-center">
                            <label>
                                <input type="radio" name="layout_type" value="two" >
                                <img src="{{ asset('assets/images/logo/two-layout.jpg') }}" class="mx-auto border" style="height: 300px;object-fit:cover">
                            </label>
                        </div> 
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border shadow-sm">
                        <div class="card-header bg-light">
                            <label  for="three"><b>Layout Three</b></label>
                        </div>
                        <div class="card-body text-center">
                            <label>
                                <input type="radio" name="layout_type" value="three" >
                                <img src="{{ asset('assets/images/logo/three-layout.jpg') }}" class="mx-auto border" style="height: 300px;object-fit:cover">
                            </label>
                        </div> 
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border shadow-sm">
                        <div class="card-header bg-light">
                            <label  for="four"><b>Layout Four</b></label>
                        </div>
                        <div class="card-body text-center">
                            <label>
                                <input type="radio" name="layout_type" value="four" >
                                <img src="{{ asset('assets/images/logo/four-layout.jpg') }}" class="mx-auto border" style="height: 300px;object-fit:cover">
                            </label>
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
       
$("#layout-form").validate({
    submitHandler:function(form) {
        var rvalue = $('input[name="layout_type"]:checked').val();
        if( rvalue != '' && rvalue != null && rvalue != 'undefined'){
            $('#pdf_template').val(rvalue);
            $('#layout_selected').html('Layout' + rvalue.toUpperCase());
            $('#Mymodal').modal('hide');
        }
        return false;
    }
});
        
</script>
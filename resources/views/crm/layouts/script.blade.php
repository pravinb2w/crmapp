<!-- bundle -->
<script src="{{ asset('assets/js/vendor.min.js') }}"></script>
<script src="{{ asset('assets/js/app.min.js') }}"></script>

<!-- Apex js -->
<script src="{{ asset('assets/js/vendor/apexcharts.min.js') }}"></script>

<!-- Todo js -->
<script src="{{ asset('assets/js/ui/component.todo.js') }}"></script>

<!-- demo app -->
{{-- <script src="{{ asset('assets/js/pages/demo.dashboard-crm.js') }}"></script> --}}
<!-- end demo js-->
<script>
    function get_add_modal(page_type) {
        $('#Mymodal').modal('show');
        return false;
        $.ajax({
            url:'',
            method:'POST',
            data: {page_type:page_type},
            success:function(res){
                $('#Mymodal').modal('show');
            }
        })
    }
</script>
<div class="modal-dialog modal-lg modal-right">
    <style>
        .custom-scroll {
            max-height: 675px;
            overflow-y: auto;
        }
    </style>
    <div class="modal-content">
        <div class="modal-header px-3" id="myLargeModalLabel">{{ $modal_title }}</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form class="form-horizontal modal-body" id="customers-form" method="POST" action="{{ route('customers.save') }}" autocomplete="off">

        <div class="modal-body justify-content-center align-items-center h-100 p-3 custom-scroll">
            <div class="w-100">
                <div class="row">
                    <div class="col-12" id="error"></div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="role_id"> Role <span class="text-danger">*</span></label>
                            <select name="role_id" id="role_id" class="form-control">
                                <option value="">--select--</option>
                                @if( isset( $role ) && !empty($role))
                                    @foreach ($role as $item)
                                        <option value="{{ $item->id }}" >{{ $item->role }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <table class="table table-borderd ">
                            <thead>
                                <tr>
                                    <th>Menu</th>
                                    <th>Permission</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( config('constant.role_menu') as $item )
                                <tr>
                                    <td>
                                        {{ str_replace('_', ' ', ucwords($item) ) }}
                                    </td>
                                    <td>
                                        <div class="mt-2">
                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" class="form-check-input" id="visible_{{ $item }}">
                                                <label class="form-check-label" for="visible_{{ $item }}">Visible</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" class="form-check-input" id="editable_{{ $item }}">
                                                <label class="form-check-label" for="editable_{{ $item }}">Edit</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" class="form-check-input" id="visible_{{ $item }}">
                                                <label class="form-check-label" for="visible_{{ $item }}">Delete</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" class="form-check-input" id="assign_{{ $item }}">
                                                <label class="form-check-label" for="assign_{{ $item }}">Assign</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" class="form-check-input" id="export_{{ $item }}">
                                                <label class="form-check-label" for="export_{{ $item }}">Export</label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <input type="hidden" name="id" value="{{ $info->id ?? '' }}">
                    
                </div>  
            </div>
        </div>
        <div class="modal-footer px-3">
            <div class="col-12 text-end">
                <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal" aria-label="Close"> Cancel</button>
                <button type="submit" class="btn btn-primary" id="save">Save</button>
            </div>
        </div>
    </div><!-- /.modal-content -->
</div>

<script>
   

        
</script>
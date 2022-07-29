<div class="card border">
    <div class="card-header d-flex justify-content-between align-items-center">
        <label for="">Meta Details </label> 
        <a class="btn btn-light border btn-sm" id="add_meta_data">+ Add</a>
    </div>
    <div class="card-body p-2">
        <div >
            <table class="table m-0 table-hover table-bordered rounded  ">
                <thead class="bg-light">
                    <tr>
                        <th class="py-1 text-center">Meta Name</th>
                        <th class="py-1 text-center">Meta Description</th>
                        <th class="text-center"><i class="text-danger bi bi-trash"></i></th>
                    </tr>
                </thead>
                <tbody id="meta_pane" >
                    <tr>
                        <td class="p-0">
                           <input type="text" name="meta_name[]" class="border-0 border-bottom form-control form-control-sm">
                        </td>
                        <td class="p-0">
                            <input type="text" name="meta_description[]" id="" value="" placeholder="" class="border-0 border-bottom form-control form-control-sm">
                        </td> 
                        <td class="text-center p-0"><i onclick='metaDelete(this);' class="bi bi-x btn p-1 py-0 border btn-sm btn-light"></i></td>
                    </tr> 
                </tbody>
            </table>
        </div>
    </div>
</div>
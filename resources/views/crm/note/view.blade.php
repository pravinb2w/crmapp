<div class="modal-dialog modal-md">
    
    <div class="modal-content h-100">
        <div class="modal-header px-3" id="myLargeModalLabel">
            <h4>{{ $modal_title }}</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="max-height: 95vh;overflow:auto">

                <div class="modal-body d-flex justify-content-center align-items-center h-100 p-3">
                    <div class="w-100">
                        <div class="row">
                            <div class="col-12" id="error"></div>
                        </div>
                        <div class="row">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th  class="table-light">Notes</th>
                                        <td>{{ $info->notes ?? '' }}</td>
                                    </tr>
                                    @if(isset( $info->customer->first_name ) && !empty($info->customer->first_name))
                                    <tr>
                                        <th class="table-light"> Customer </th>
                                        <td>  {{ $info->customer->first_name ?? 'N/A' }} </td>
                                    </tr>
                                    @endif
                                    @if(isset( $info->user->name ) && !empty($info->user->name))
                                    <tr>
                                        <th class="table-light"> User </th>
                                        <td>  {{ $info->user->name ?? 'N/A' }} </td>
                                    </tr>
                                    @endif
                                    @if(isset( $info->lead->lead_subject ) && !empty($info->lead->lead_subject))
                                    <tr>
                                        <th class="table-light"> Lead </th>
                                        <td>  {{ $info->lead->lead_subject ?? 'N/A' }} </td>
                                    </tr>
                                    @endif
                                    @if(isset( $info->deal->deal_title ) && !empty($info->deal->deal_title))
                                    <tr>
                                        <th class="table-light"> Deal </th>
                                        <td>  {{ $info->deal->deal_title ?? 'N/A' }} </td>
                                    </tr>
                                    @endif
                                </thead>
                            </table>
                        </div>

                            <div class="col-md-12 mt-2 text-end">
                                <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal" aria-label="Close"> Close</button>
                            </div>
                        </div>  
                    </div>
                </div>
            </form>
        </div>
    </div><!-- /.modal-content -->
</div>

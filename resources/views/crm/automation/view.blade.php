<div class="modal-dialog modal-xl">
    <style>
        .automation-table th,td {
            vertical-align: middle;
        }
    </style>
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
                            <div class="col-12">
                                <table class="table table-striped table-bordered table-hover automation-table ">
                                    <thead>

                                    <tr>
                                        <th>Activity Type</th>
                                        <td colspan="5">
                                            {{ $info->activity_type ?? '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Mail to Customer</th>
                                        <td>
                                            {{ ( $info->is_mail_to_customer == 1 ) ? 'Yes' : 'No'; }}
                                        </td>
                                        <th>
                                            Customer Email Template
                                        </th>
                                        <td colspan="3">
                                            {!! $info->customer_template->content ?? 'N/A' !!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Mail to Team</th>
                                        <td>
                                            {{ ( $info->is_mail_to_team == 1 ) ? 'Yes' : 'No'; }}
                                        </td>
                                        <th>
                                            Team Email Template
                                        </th>
                                        <td colspan="3">
                                            {!! $info->team_template->content ?? 'N/A' !!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> Team Notification </th>
                                        <td>
                                            {{ ($info->is_notification_to_team == 1) ? 'Yes' : 'No' }}
                                        </td>
                                        <th>Notification Title</th>
                                        <td >
                                            {{ $info->notification_title ?? 'N/A' }}
                                        </td>
                                        <th>Notification Message</th>
                                        <td >
                                            {{ $info->notification_message ?? 'N/A' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td colspan="5">{{  ($info->status == 1) ? 'Active' : 'Inactive';  }}</td>
                                    </tr>
                                    </thead>
                                </table>
                                
                            </div>
                            
                        </div>
                            
                        <div class="col-md-12 mt-2 text-end">
                            <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal" aria-label="Close"> Close</button>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </div><!-- /.modal-content -->
</div>

<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myLargeModalLabel">{{ $modal_title }}</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Subscription</th>
                                            <th>Time Period</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $info->subscription_name }}</td>
                                        @php
                                            $duration = '';
                                        @endphp
                                        @if( isset( $info->subscription_period ) && !empty($info->subscription_period)) 
                                            @php
                                                $period = explode("-",$info->subscription_period);
                                                $subscription_period = $period[0];
                                                $duration = end($period);
                                            @endphp
                                        @endif
                                            <td>
                                                {{ $subscription_period .' '.( ( $duration == 'M' ) ? 'Months' : ( $duration == 'Y' ? 'Years' : 'Days')  ) }}
                                            </td>
                                            <td>
                                                {{ $info->amount }}
                                            </td>
                                            <td>
                                                {{ $info->status == '1' ? 'Active' : 'Inactive' }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Access</th>
                                            <th>N0 of count</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Client</td>
                                            <td>{{ $info->no_of_clients ?? '0' }}</td>
                                        </tr> 
                                        <tr>
                                            <td>Employees</td>
                                            <td>{{ $info->no_of_employees ?? '0' }}</td>
                                        </tr>                                        
                                        <tr>
                                            <td>Leads</td>
                                            <td>{{ $info->no_of_leads ?? '0' }}</td>
                                        </tr> 

                                         <tr>
                                            <td>Pages</td>
                                            <td>{{ $info->no_of_pages ?? '0' }}</td>
                                        </tr> 
                                        <tr>
                                            <td>Email Template </td>
                                            <td>{{ $info->no_of_email_templates ?? '0' }}</td>
                                        </tr> 
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Access</th>
                                            <th>On/Off</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Bulk Import</td>
                                            <td>{{ $info->bulk_import ?? 'off' }}</td>
                                        </tr> 
                                        <tr>
                                            <td>Database Backup</td>
                                            <td>{{ $info->database_backup ?? 'off' }}</td>
                                        </tr>                                        
                                        <tr>
                                            <td> Work Automation</td>
                                            <td>{{ $info->work_automation ?? 'off' }}</td>
                                        </tr> 

                                         <tr>
                                            <td>Telegram Bot</td>
                                            <td>{{ $info->telegram_bot ?? 'off' }}</td>
                                        </tr> 
                                        <tr>
                                            <td>SMS Integration</td>
                                            <td>{{ $info->sms_integration ?? 'off' }}</td>
                                        </tr> 
                                        <tr>
                                            <td> Payment Gateway </td>
                                            <td> {{ $info->payment_gateway ?? 'off' }}</td>
                                        </tr>
                                        <tr>
                                            <td> Web Whatsapp </td>
                                            <td> {{ $info->business_whatsapp ?? 'off'  }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
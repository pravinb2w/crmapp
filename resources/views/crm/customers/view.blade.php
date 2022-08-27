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
                            <table class="table ">
                                <tr>
                                    <th> First Name </th>
                                    <td>  {{ $info->first_name ?? '' }} </td>
                                </tr>
                                <tr>
                                    <th> Last Name </th>
                                    <td>  {{ $info->last_name ?? '' }} </td>
                                </tr>
                                <tr>
                                    <th>
                                        Phone Number
                                    </th>
                                    <td>
                                        {{ $info->mobile_no ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Email
                                    </th>
                                    <td>
                                        {{ $info->email ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Organization
                                    </th>
                                    <td>
                                        {{ $info->company->name ?? 'N/A' }}
                                    </td>
                                </tr>
                                @if( isset( $info->secondary_mobile ) && count($info->secondary_mobile) > 0 )
                                <tr>
                                    <th>
                                        Secondary Phone Number
                                    </th>
                                  
                                        <td>
                                            <table>
                                                @foreach ($info->secondary_mobile as $item)
                                                <tr>
                                                    <td>
                                                        {{ $item->mobile_no ?? '' }}

                                                    </td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                </tr>
                                @endif
                                @if( isset( $info->secondary_email ) && count($info->secondary_email) > 0 )
                                <tr>
                                    <th>
                                        Secondary Email
                                    </th>
                                   
                                    <td>
                                        <table>
                                            @foreach ($info->secondary_email as $item)
                                            <tr>
                                                <td>
                                                    {{ $item->email ?? '' }}
                                                </td>
                                            </tr>
                                            @endforeach
                                        </table>
                                    </td>
                                   
                                </tr>
                                @endif
                            </table>
                        </div>
                        
                            <div class="col-md-12 mb-3 text-end">
                                <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal" aria-label="Close"> Close</button>
                            </div>
                        </div>  
                    </div>
                </div>
            </form>
        </div>
    </div><!-- /.modal-content -->
</div>

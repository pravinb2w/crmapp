<table>
    <tr>
        <th>
            <label for="no_of_clients" class="col-form-label">Client <small class="text-muted"> (nos)  </small></label>
        </th>
        <td>
            <div class="">
                <input type="number" name="no_of_clients" class="form-control" id="no_of_clients" placeholder="0" value="{{ $info->no_of_clients ?? '' }}" >
            </div>
        </td>
        <th>
            <label for="no_of_employees" class="col-form-label">Employees <small class="text-muted"> (nos)  </small></label>
        </th>
        <td>
            <div class="">
                <input type="number" name="no_of_employees" class="form-control" id="no_of_employees" placeholder="0" value="{{ $info->no_of_employees ?? '' }}" >
            </div>
        </td>
        <th>
            <label for="no_of_pages" class="col-form-label">Pages <small class="text-muted"> (nos)  </small></label>
        </th>
        <td>
            <div class="">
                <input type="number" name="no_of_pages" class="form-control" id="no_of_pages" placeholder="0" value="{{ $info->no_of_pages ?? '' }}" >
            </div>
        </td>
    </tr>
    <tr>
        <th>
            <label for="no_of_deals" class="col-form-label">Deals <small class="text-muted"> (nos)  </small></label>
        </th>
        <td>
            <div class="">
                <input type="number" name="no_of_deals" class="form-control" id="no_of_deals" placeholder="0" value="{{ $info->no_of_deals ?? '' }}" >
            </div>
        </td>
        <th>
            <label for="no_of_deal_stages" class="col-form-label">Deal Stages <small class="text-muted"> (nos)  </small></label>
        </th>
        <td>
            <div class="">
                <input type="number" name="no_of_deal_stages" class="form-control" id="no_of_deal_stages" placeholder="0" min="0" value="{{ $info->no_of_deal_stages ?? '' }}" >
            </div>
        </td>
        <th>
            <label for="no_of_products" class="col-form-label">Products <small class="text-muted"> (nos)  </small></label>
        </th>
        <td>
            <div class="">
                <input type="number" name="no_of_products" class="form-control" id="no_of_products" min="0" placeholder="0" value="{{ $info->no_of_products ?? '' }}" >
            </div>
        </td>
        
    </tr>
    <tr>
       
        <th>
            <label for="no_of_email_templates" class="col-form-label">Email Template <small class="text-muted"> (nos)  </small></label>
        </th>
        <td>
            <div class="">
                <input type="number" name="no_of_email_templates" class="form-control" id="no_of_email_templates" placeholder="0" value="{{ $info->no_of_email_templates ?? '' }}" >
            </div>
        </td>
        
        <th>
            <label for="no_of_sms_templates" class="col-form-label">SMS Template <small class="text-muted"> (nos)  </small></label>
        </th>
        <td>
            <div class="">
                <input type="number" name="no_of_sms_templates" class="form-control" id="no_of_sms_templates" placeholder="0" min="0" value="{{ $info->no_of_sms_templates ?? '' }}" >
            </div>
        </td>
        <th>
            <label for="server_space" class="col-form-label">Server Space<small class="text-muted"> (GB)  </small></label>
        </th>
        <td>
            <div class="">
                <input type="number" name="server_space" class="form-control" id="server_space" placeholder="0" min="0" value="{{ $info->server_space ?? '' }}" >
            </div>
        </td>
    </tr>
</table>
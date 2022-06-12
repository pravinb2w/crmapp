<html>
    <head>
        <style>
            /** Define the margins of your page **/
            @page {
                margin: 100px 25px;
            }

            header {
                position: fixed;
                top: -80px;
                left: 0px;
                right: 0px;
                /** Extra personal styles **/
                text-align: center;
                line-height: 15px;
            }

            footer {
                position: fixed; 
                bottom: 0px; 
                left: 0px; 
                right: 0px;
                border-bottom: 1px solid;
                /** Extra personal styles **/
            }
            main {
                position: fixed;
                top: 78px;
            }

            .footer-table td {
                border-collapse: separate !important;
                border: 1px solid;
                padding: 10px;
            }
            .header-table td {
                border-collapse: separate !important;
                border: 1px solid;
                padding: 2px;
            }
            .info-table td {
                border-collapse: separate !important;
                border: 1px solid;
                padding: 5px; 
            }
            .item-table th {
                border-collapse: separate !important;
                border: 1px solid;
                padding: 5px; 
            }
            .item-table td {
                border-collapse: separate !important;
                border: 1px solid;
                padding: 4px;
            }
            .page-break {
                page-break-after: always;
            }
            .signature-table {
                border: 1px solid;
                border-top: none;
            }
            .sub-table th, td {
                border: none;
                font-size: 12px;
                padding: 0px;
            }
            .sub-table {
                border: 1px solid;
            }
        </style>
    </head>
    <body style="border-left: 1px solid #ddd;border-right:1px solid #ddd">
        <!-- Define header and footer blocks before your content -->
        <header>
            <table style="width: 100%;" class="header-table" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="width:25%;border-right:none;">
                        <img src="{{ public_path().'/assets/images/logo/logo.png' }}" alt="" width="155">
                    </td>
                    <td style="width: 20%;text-align:left;border-left:none;border-right:none;">
                     <address>
                        <h4>{{ strtoupper($company->site_name) ?? '' }}</h4>
                        {{ $company->address ?? '' }} <br>
                        {{ $company->site_email ?? '' }}
                        GSTIN: {{ $company->gstin_no ?? 'n/a' }}
                     </address>
                    </td>
                    <td style="width: 50%;
                    text-align: right;
                    vertical-align: bottom;
                    padding-right: 20px;
                    font-size: 22px;border-left:none;">
                        <span>INVOICE</span>
                    </td>
                </tr>
            </table>
        </header>
        <!-- Wrap the content of your PDF inside a main tag -->
        <footer>

        </footer>
        <main style="width:100%" >
            <table class="info-table" style="width: 100%;font-size:13px;"  border="0" cellspacing="0" cellpadding="0">
                <tr>
                    
                    <td style="width: 50%;padding:5px;">
                        <table class="invoice" style="width:50%;font-size:13px;">
                            <tr>
                                <th style="text-align: left; width:50%;">Invoice No:</th>
                                <th style="text-align: left; width:50%;"> {{ $info->invoice_no ?? '' }} </th>
                            </tr>
                            <tr>
                                <th style="text-align: left; width:50%;">Invoice Date:</th>
                                <th style="text-align: left; width:50%;">{{ date( 'd/M/Y', strtotime( $info->created_at ) ) }}</th>
                            </tr>
                            <tr>
                                <th style="text-align: left; width:50%;">Due Date:</th>
                                <th style="text-align: left; width:50%;">{{ date('d/M/Y', strtotime( $info->due_date )) }}</th>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table class="invoice" style="width:50%;font-size:13px;">
                            <tr>
                                <th style="text-align: left; width:50%;"> State:</th>
                                <th style="text-align: left; width:50%;"> Tamil Nadu </th>
                            </tr>
                            <tr>
                                <th style="text-align: left; width:50%;"> Place:</th>
                                <th style="text-align: left; width:50%;"> Chennai </th>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <th colspan="2" style="text-align: left;padding:5px 10px;background: #80808026;border-left:1px solid;border-right:1px solid;">Bill To</th>
                </tr>
                <tr>
                    <td style="width: 50%;padding:10px;" colspan="2">
                        <div > 
                            <strong>Customer Details:</strong>
                                <address class="ps-2">
                                {{ $info->customer->first_name ?? '' }} {{ $info->customer->last_name ?? '' }}<br />
                                {{ $info->address ?? $info->customer->company->address ?? '' }}
                                <br>
                                {{ $info->customer->mobile_no ?? '' }}
                                </address>
                        </div>
                    </td>
                    
                </tr>
            </table>
            <table class="item-table" style="width: 100%;font-size:12px;border-bottom:1px solid" border="0" cellspacing="0" cellpadding="0">
                <tr style="">
                    <th style="text-align: center;background: #80808026;"><strong>#</strong></th>
                    <th style="text-align: center;background: #80808026;"><strong>Description of Goods</strong></th>
                    <th style="text-align: center;background: #80808026;"><strong>HSN/SAC</strong></th>
                    <th style="text-align: center;background: #80808026;"><strong>Qty</strong></th>
                    <th style="text-align: center;background: #80808026;"><strong>Unit Price</strong></th>
                    <th style="text-align: center;background: #80808026;"><strong>Discount</strong></th>
                    <th style="text-align: center;background: #80808026;"><strong>Cgst %</strong></th>
                    <th style="text-align: center;background: #80808026;"><strong>Sgst %</strong></th>
                    <th style="text-align: center;background: #80808026;"><strong>Igst %</strong></th>
                    <th style="text-align: center;background: #80808026;"><strong>Amount</strong></th>
                </tr>
                @if( isset( $info->items ) && count($info->items) > 0 ) 
                   @php
                       $i = 1;
                       $tax_var = [];
                       $sub_total = 0;
                       $cgst_total = 0;
                       $igst_total = 0;
                       $sgst_total = 0;
                       $discount_total = 0;
                   @endphp
                       @foreach ($info->items as $item)
                        @php
                            $pro_total = 0;
                            $pro_total = $item->qty * $item->unit_price;
                            $sub_total += $pro_total;
                            
                            $cgst_amount = 0;
                            $sgst_amount = 0;
                            $igst_amount = 0;
                            $total = 0;
                            
                            if( $item->cgst != 0 && $item->cgst != null) {
                                $cgst_amount = $pro_total * $item->cgst/100; 
                                $cgst_total += $cgst_amount;
                            }
                            if( $item->sgst != 0 && $item->sgst != null ) {
                                $sgst_amount = $pro_total * $item->sgst/100; 
                                $sgst_total += $sgst_amount;
        
                            }
                            if( $item->igst != 0 && $item->igst != null ) {
                                $igst_amount = $pro_total * $item->igst/100; 
                                $igst_total += $igst_amount;
        
                            }
        
                        @endphp
                       <tr>
                           <td>{{ $i; }}</td>
                           <td> {{ $item->product->product_name ?? '' }}</td>
                           <td style="text-align: right">{{ $item->product->hsn_no ?? '' }}</td>
                           <td style="text-align: right">{{ $item->qty ?? '' }}</td>
                           <td style="text-align: right">{{ $item->unit_price ?? '' }}</td>
                           <td style="text-align: right">{{ $item->discount ?? '0' }}%</td>
                           <td style="text-align: right">{{ $item->cgst ?? '' }}</td>
                           <td style="text-align: right">{{ $item->sgst ?? '' }}</td>
                           <td style="text-align: right">{{ $item->igst ?? '' }}</td>
                           <td style="text-align: right">{{ $pro_total ?? '' }}</td>
                       </tr> 
                       @php
                           $i++;
                       @endphp
                       @endforeach
                   @endif
            </table>
            <table class="total-table" style="width: 100%;font-size:12px;" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="padding: 10px;width:65%">
                        <h4>Amount in Words</h4>
                        <p>{{ AmountInWords($info->total) }}</p>

                        <div>
                            <h5>Terms and Condition</h5>
                            <address style="font-size:11px;">
                                {{ $company->invoice_terms ?? 'N/A'; }}
                            </address>

                        </div>
                        <div style="font-size:10px;margin-top:10px;">
                            Thanks for your business.
                            This is computer generated invoice hence no signature required
                        </div>
                    </td>
                    <td style="width:35%;padding:0px;">
                        <table class="sub-table" style="width: 100%;margin-top:-5px;" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td style="width: 64%;text-align:right">Sub Total</td>
                                <td style="text-align:right;width:36%;padding-right:5px;">{{ $sub_total }}</td>
                            </tr>
                            <tr>
                                <td style="width: 64%;text-align:right">CGST</td>
                                <td style="text-align:right;width:36%;padding-right:5px;">{{ $cgst_total }}</td>
                            </tr>
                            <tr>
                                <td style="width: 64%;text-align:right">SGST</td>
                                <td style="text-align:right;width:36%;padding-right:5px;">{{ $sgst_total }}</td>
                            </tr>
                            <tr>
                                <td style="width: 64%;text-align:right">IGST</td>
                                <td style="text-align:right;width:36%;padding-right:5px;">{{ $igst_total }}</td>
                            </tr> 
                            <tr>
                                <td style="width: 64%;text-align:right">Discount</td>
                                <td style="text-align:right;width:36%;padding-right:5px;">0</td>
                            </tr>
                            <tr>
                                <th style="width: 64%;text-align:right">Grand Total</th>
                                <td style="text-align:right;width:36%;padding-right:5px;">{{ $info->currency ?? '' }} {{ $info->total }}</td>
                            </tr>
                        </table>
                        <table class="signature-table"style="width: 100%;text-align:center;" border="0" cellspacing="0" cellpadding="0" >
                            <tr>
                                <td style="padding: 15px;">

                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 15px;">
                                    
                                </td>
                            </tr><tr>
                                <td style="padding: 15px;">
                                    
                                </td>
                            </tr><tr>
                                <td style="padding: 5px;">
                                    
                                </td>
                            </tr><tr>
                                <td style="padding: 0px 5px;">
                                    Authorized Signature
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </main>
    </body>
</html>
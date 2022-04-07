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
                height: 50px;
                /** Extra personal styles **/
                text-align: center;
                line-height: 15px;
            }

            footer {
                position: fixed; 
                bottom: -60px; 
                left: 0px; 
                right: 0px;
                /** Extra personal styles **/
            }
            main {
                position: fixed;
                top: 50px;
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
                border-left: 1px solid;
                border-right: 1px solid;
                padding: 5px; 
            }
            .page-break {
                page-break-after: always;
            }
            .tax-table td {
                border: 1px solid;
                padding: 2px;
            }
        </style>
    </head>
    <body style="border-left: 1px solid #ddd;border-right:1px solid #ddd">
        <!-- Define header and footer blocks before your content -->
        <header>
            <table style="width: 100%;" class="header-table" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="width: 100%;text-align:center;">
                     <address>
                        <h3>{{ $company->site_name ?? '' }}</h3>
                        {{ $company->address ?? '' }} <br>
                        {{ $company->site_email ?? '' }}
                        <h4>GSTIN: 89898999999999999</h4>
                     </address>
                    </td>
                </tr>
            </table>
        </header>
        
        <footer>
            <table style="width: 100%" class="footer-table" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="width: 100%">
                        <h5>Terms and Condition</h5>
                        <address style="font-size:11px;">
                            {{ $company->invoice_terms ?? 'N/A'; }}
                        </address>
                    </td>
                    <td style="width:25%;"> 
                        <div>
                            <h5 style="margin-bottom:20px;">E&O.E</h5>
                            <p style="padding-top:20px;">Receiver's Signature</p>
                        </div>
                    </td>
                    <td style="width: 25%;">
                        <div>
                            <h5 style="margin-bottom:20px;">For Company</h5>
                            <p style="padding-top:20px;">Authorized Signatory</p>
                        </div>
                    </td>
               </tr>
           </table>

        </footer>

        <!-- Wrap the content of your PDF inside a main tag -->
        <main style="width:100%" >
            <table class="info-table" style="width: 100%;font-size:13px;"  border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="width: 50%;padding:10px;">
                        <div  > 
                            <strong>Customer Details:</strong>
                             <address class="ps-2">
                                {{ $info->customer->first_name ?? '' }} {{ $info->customer->last_name ?? '' }}<br />
                                {{ $info->address ?? '' }}
                                <br>
                                {{ $info->customer->mobile_no ?? '' }}
                             </address>
                        </div>
                    </td>
                    <td style="width: 50%;padding:5px;">
                        <table class="invoice" style="width:100%;font-size:13px;">
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
                </tr>
            </table>
            <table class="item-table" style="width: 100%;font-size:12px;border-bottom:1px solid" border="0" cellspacing="0" cellpadding="0">
                <tr style="">
                    <th style="text-align: center"><strong>No</strong></th>
                    <th style="text-align: center"><strong>Description of Goods</strong></th>
                    <th style="text-align: center"><strong>HSN/SAC</strong></th>
                    <th style="text-align: center"><strong>Qty</strong></th>
                    <th style="text-align: center"><strong>Unit Price</strong></th>
                    <th style="text-align: center"><strong>Discount</strong></th>
                    <th style="text-align: center"><strong>Cgst %</strong></th>
                    <th style="text-align: center"><strong>Sgst %</strong></th>
                    <th style="text-align: center"><strong>Igst %</strong></th>
                    <th style="text-align: center"><strong>Amount</strong></th>
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
                @if( count($info->items) > 0 && count($info->items ) < 10 )
                @for ($i = 0; $i < 30; $i++)
                <tr>
                    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                </tr>
                @endfor
                @else
                <tr>
                    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                </tr>
                <tr>
                    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                </tr>
                <tr>
                    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                </tr>
                <tr>
                    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                </tr>
                <tr>
                    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                </tr>
                <tr>
                    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                </tr>
                <tr>
                    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                </tr>
                @endif
            </table>
            <table class="total-table" style="width: 100%;font-size:12px;border-bottom:1px solid" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="padding: 10px;width:65%">
                        <h4>Amount in Words</h4>
                        <p>{{ AmountInWords($info->total) }}</p>
                    </td>
                    <td style="width:35%;padding-bottom:30px; ">
                        <table style="width: 100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <th style="width: 64%;border:1px solid;">Sub Total</th>
                                <td style="text-align:right;width:36%;padding-right:5px;border:1px solid;">{{ $sub_total }}</td>
                            </tr>
                            <tr>
                                <th style="width: 64%;border:1px solid;">CGST</th>
                                <td style="text-align:right;width:36%;padding-right:5px;border:1px solid;">{{ $cgst_total }}</td>
                            </tr>
                            <tr>
                                <th style="width: 64%;border:1px solid;">SGST</th>
                                <td style="text-align:right;width:36%;padding-right:5px;border:1px solid;">{{ $sgst_total }}</td>
                            </tr>
                            <tr>
                                <th style="width: 64%;border:1px solid;">IGST</th>
                                <td style="text-align:right;width:36%;padding-right:5px;border:1px solid;">{{ $igst_total }}</td>
                            </tr> 
                            <tr>
                                <th style="width: 64%;border:1px solid;">Discount</th>
                                <td style="text-align:right;width:36%;padding-right:5px;border:1px solid;">0</td>
                            </tr>
                            <tr>
                                <th style="width: 64%;border:1px solid;">Grand Total</th>
                                <td style="text-align:right;width:36%;padding-right:5px;border:1px solid;">{{ $info->currency ?? '' }} {{ $info->total }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <table style="width:100%;">
                <tr>
                    <td style="width:100%;padding:20px;">
                        <table class="tax-table" style="width: 100%;border:1px;font-size:12px;" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td style="padding:5px;" rowspan="2">
                                    HSN Code
                                </td>
                                <td style="text-align:center" colspan="2">CGST</td>
                                <td style="text-align: center" colspan="2">SGST</td>
                                <td style="text-align:center" colspan="2">IGST</td>
                                <td style="padding:5px;" rowspan="2">Grand Total</td>
                            </tr>
                            <tr>
                                <td style="padding:5px;">CGST %</td>
                                <td style="padding:5px;"> CGST Amnt</td>
                                <td style="padding:5px;"> SGST %</td>
                                <td style="padding:5px;"> SGST Amnt</td>
                                <td style="padding:5px;"> IGST %</td>
                                <td style="padding:5px;"> IGST Amnt</td>
                            </tr>
                           
                            @if( isset( $taxable ) && !empty($taxable ) )
                            @php
                                $grand_total = 0;
                                $grand_cgst = 0;
                                $grand_sgst = 0;
                                $grand_igst = 0;
                            @endphp
                                @foreach ($taxable as $tax)
                                @php
                                    $cgst_amount = 0;
                                   $sgst_amount = 0;
                                   $igst_amount = 0;
                                    $total = 0;
                                   
                                    if( $tax->cgst != 0 && $tax->cgst != null) {
                                        $cgst_amount = $tax->price * $tax->cgst/100; 
                                        $grand_cgst += $cgst_amount;
                                    }
                                    if( $tax->sgst != 0 && $tax->sgst != null ) {
                                        $sgst_amount = $tax->price * $tax->sgst/100; 
                                        $grand_sgst += $sgst_amount;
            
                                    }
                                    if( $tax->igst != 0 && $tax->igst != null ) {
                                        $igst_amount = $tax->price * $tax->igst/100; 
                                        $grand_igst += $igst_amount;
            
                                    }
                                    $total = $cgst_amount + $sgst_amount + $igst_amount;
                                    $grand_total += $total;
                                @endphp
                                    <tr>
                                        <td  style="padding:5px;">{{ $tax->hsn_no }}</td>
                                        <td style="padding:5px;text-align:center">{{ $tax->cgst ?? 0 }}</td>
                                        <td style="padding:5px;text-align:center">{{ $cgst_amount }}</td>
                                        <td style="padding:5px;text-align:center">{{ $tax->sgst ?? 0 }}</td>
                                        <td style="padding:5px;text-align:center">{{ $sgst_amount }}</td>
                                        <td style="padding:5px;text-align:center">{{ $tax->igst ?? 0 }}</td>
                                        <td style="padding:5px;text-align:center">{{ $igst_amount }}</td>
                                        <td style="padding:5px;text-align:center">{{ $total }}</td>
                                    </tr>   
                                @endforeach
                                <tr>
                                    <td  style="padding:5px;">Grand Total</td>
                                    <td style="padding:5px;text-align:center"></td>
                                    <td style="padding:5px;text-align:center">{{ $grand_cgst }}</td>
                                    <td style="padding:5px;text-align:center"></td>
                                    <td style="padding:5px;text-align:center">{{ $grand_sgst }}</td>
                                    <td style="padding:5px;text-align:center"></td>
                                    <td style="padding:5px;text-align:center">{{ $grand_igst }}</td>
                                    <td style="padding:5px;text-align:center">{{ $grand_total }}</td>
                                </tr>
                            @endif
                        </table>
                    </td>
                </tr>
            </table>
            


        </main>
    </body>
</html>
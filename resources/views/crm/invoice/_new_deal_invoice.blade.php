  <!-- App css -->
  <html>
    <head>
       <style>
           .invoice-container {
               margin: 15px auto;
               padding: 70px;
               max-width: 850px;
               background-color: #fff;
               border: 1px solid #ccc;
               -moz-border-radius: 6px;
               -webkit-border-radius: 6px;
               -o-border-radius: 6px;
               border-radius: 6px;
           }
       
           @media (max-width: 767px) {
               .invoice-container {
                   padding: 35px 20px 70px 20px;
                   margin-top: 0px;
                   border: none;
                   border-radius: 0px;
               }
           } 
           .item-table {
               width: 100%;
               margin-bottom: 1.5rem;
               color: #6c757d;
               vertical-align: top;
               border-color: #eef2f7;
           }
          
           .item-table tr td {
               border-bottom-width: 1px; 
               padding: 3px;
               border-color: #6c757d;

           }
           .item-table tr th {
               background:lightgray;color:black
           }
           .item-table > :not(:first-child) {
               border-top: 2px solid #edeff1;
           }
           table.tax-table td {
                border: 1px solid;
                padding: 2px;
            }
       </style>

    </head>
    <body>
       <div class="container-fluid invoice-container">
           <table style="width: 100%;">
               <tr>
                   <td style="width: 25%;">
                       <div class="col-sm-7 text-center text-sm-start mb-3 mb-sm-0">
                           {{-- @if( isset($company->site_logo) && !empty($company->site_logo))
                           <img id="logo" style="width: 100px;" src="{{ public_path() }}/storage/{{ $company->site_logo }}" title="Phoneix" alt="Phoneix" />
                           @else
                           <img id="logo" style="width: 100px;" src="{{ public_path() }}/assets/images/logo/logo-color.png" title="Phoneix" alt="Phoneix" /> 

                           @endif --}}
                           {{-- <img id="logo" style="width: 250px" src="{{ asset('storage/'.$company->site_logo) }}" title="Phoneix" alt="Phoneix" /> --}}
                       </div>
                   </td>
                   <td style="width: 50%;text-align:center;">
                    <address class="ps-2">
                        
                        <h3>{{ $company->site_name ?? '' }}</h3>
                        {{ $company->address ?? '' }} <br>
                        {{ $company->site_email ?? '' }}
                    </address>
                   </td>
                   <td style="width:25%;"></td>
               </tr>
           </table>
           <main>
               <hr>
               <table class="table table-borderless" style="width: 100%;">
                   <tr>
                       <td style="width: 50%">
                           <div  > <strong>Customer Details:</strong>
                                <address class="ps-2">
                                    {{ $info->customer->first_name ?? '' }} {{ $info->customer->last_name ?? '' }}<br />
                                    {{ $info->address ?? '' }}
                                    <br>
                                    {{ $info->customer->mobile_no ?? '' }}
                                </address>
                           </div>
                       </td>
                       <td style="width: 50%">
                           <div> 
                                <table style="width:100%">
                                    <tr>
                                        <th style="text-align: left; width:50%;">Invoice No:</th>
                                        <td style="text-align: left; width:50%;">{{ $info->invoice_no ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th style="text-align: left; width:50%;">Invoice Date:</th>
                                        <td style="text-align: left; width:50%;">{{ date( 'd/M/Y', strtotime( $info->created_at ) ) }}</td>
                                    </tr>
                                    <tr>
                                        <th style="text-align: left; width:50%;">Due Date:</th>
                                        <td style="text-align: left; width:50%;">{{ date('d/M/Y', strtotime( $info->due_date )) }}</td>
                                    </tr>
                                    <tr>
                                        <th style="text-align: left; width:50%;">Issued Date</th>
                                        <td style="text-align: left; width:50%;">{{ date('d/M/Y', strtotime( $info->due_date )) }}</td>
                                    </tr>
                                </table>
                           </div>
                       </td>
                   </tr>
               </table>
               <hr>
               <table class="item-table" style="width: 100%;margin-top:15px;font-size:14px;">
                   <tr style="">
                       <th style="text-align: center"><strong>No</strong></th>
                       <th style="text-align: center"><strong>Product</strong></th>
                       <th style="text-align: center"><strong>Hsn No</strong></th>
                       <th style="text-align: center"><strong>Qty</strong></th>
                       <th style="text-align: center"><strong>Unit Price</strong></th>
                       <th style="text-align: center"><strong>Discount</strong></th>
                       <th style="text-align: center"><strong>Cgst %</strong></th>
                       <th style="text-align: center"><strong>Sgst %</strong></th>
                       <th style="text-align: center"><strong>Igst %</strong></th>
                       <th style="text-align: center"><strong>Amount USD</strong></th>
                   </tr>
               
                   @if( isset( $info->items ) && count($info->items) > 0 ) 
                   @php
                       $i = 1;
                       $tax_var = [];
                   @endphp
                       @foreach ($info->items as $item)
                       
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
                           <td style="text-align: right">{{ $item->amount ?? '' }}</td>
                       </tr> 
                       @php
                           $i++;
                       @endphp
                       @endforeach
                   @endif
               </table>

               <table style="width: 100%;background:rgb(248, 248, 248);">
                   <tr>
                       <td style="width: 50%;text-align:left; padding:5px 0px;">
                            <div>Amount in words</div>
                            <div>{{ AmountInWords($info->total) }}</div>
                        </td>
                       <td style="width: 50%;text-align:right; padding:5px 0px;">
                            <table style="width: 100%;text-align:right;">
                                <tr>
                                    <td style="width: 50%">
                                        <strong>Total</strong>
                                    </td>
                                    <td style="width: 50%;">
                                       {{ $info->currency ?? '' }} {{ $info->total }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                   </tr>
               </table>
               <hr>
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
               <hr>
               <table style="width: 100%;">
                <tr>
                    <td style="width: 50%">
                        <h5>Terms & Condition</h5>
                        <div style="font-size: 10px;">
                            {{ $company->invoice_terms ?? 'N/A'; }}
                        </div>
                    </td>
                    <td style="width:25%;text-align:center">
                        <div>
                            <div style="margin-bottom: 60px;margin-top:20px;">
                                <h5>E &O.E </h5>
                            </div>
                            <div>
                                <h5> Receiver's Signature</h5>
                            </div>
                        </div>
                    </td>
                    <td style="width:25%;text-align:right;">
                        <div>
                            <div style="margin-bottom: 60px;margin-top:20px;">
                                <h5> For Company </h5>
                            </div>
                            <div>
                                <h5> Authorized Signatory </h5>
                            </div>
                        </div></td>
                </tr>

               </table>
                   
           </main>  
       </div> 

    </body>
</html>


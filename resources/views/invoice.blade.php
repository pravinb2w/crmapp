@extends('crm.layouts.template')

@section('content')
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
</style>
<div class="container-fluid invoice-container">
    <header>
        <div class="row align-items-center">
            <div class="col-sm-7 text-center text-sm-start mb-3 mb-sm-0">
            <img id="logo" src="{{ asset('assets/images/logo/logo-color.png') }}" width="250px" title="Phoneix" alt="Phoneix" />
            </div>
            <div class="col-sm-5 text-center text-sm-end">
            <h4 class="text-7 mb-0">Invoice</h4>
            <strong>Invoice No:</strong> 16835
            </div>
        </div>
    </header> 
    <main>
        <hr>
        <table class="m-0 table table-borderless">
            <tr>
                <td style="padding: 0 !important" >
                    <div><strong>Date:</strong> 05/12/2020</div>
                    <div><strong>Issued:</strong> 05/12/2020</div>
                </td>
                <td  style="padding: 0 !important" class="text-end">
                    <div><strong>Due Date:</strong> 05/12/2020</div>
                </td>
            </tr>
        </table>
        <hr>
        <table class="table table-borderless">

            <tr>
                <td>
                    <div  > <strong>Pay To:</strong>
                        <address class="ps-2">
                            Phoneix Inc<br />
                            2705 N. Enterprise St<br />
                            Orange, CA 92865<br />
                            contact@Phoneixinc.com
                        </address>
                    </div>
                </td>
                <td>
                    <div> <strong>Invoiced To:</strong>
                        <address class="ps-2">
                            Smith Rhodes<br />
                            15 Hodges Mews, High Wycombe<br />
                            HP12 3JL<br />
                            United Kingdom
                        </address>
                    </div>
                </td>
            </tr>
        </table>
        <div class="border">
            <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead class="bg-light">
                        <tr>
                            <td class="text-center"><strong>Description</strong></td>
                            <td class="text-center"><strong>Qty</strong></td>
                            <td class="text-center"><strong>Unit Price</strong></td>
                            <td class="text-center"><strong>Discount</strong></td>
                            <td class="text-center"><strong>Tax</strong></td>
                            <td class="text-center"><strong>Amount USD</strong></td>
                        </tr>
                    </thead>
                <tbody>
                    @for ($key=0;$key<5;$key++)
                    <tr>
                        <td> Primeum Paln</td>
                        <td class="text-end">1{{ $key+1 }}</td>
                        <td class="text-end">75.00</td>
                        <td class="text-end">0.00%</td>
                        <td>Tax on Purcheses</td>
                        <td class="text-end">754</td>
                    </tr> 
                    @endfor
                </tbody>
                <tfoot class="bg-light">
                    <tr>
                        <td colspan="5" class="text-end"><strong>Sub Total:</strong></td>
                        <td class="text-end">$2150.00</td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-end"><strong>Tax:</strong></td>
                        <td class="text-end">$215.00</td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-end border-bottom-0"><strong>Total:</strong></td>
                        <td class="text-end border-bottom-0">$2365.00</td>
                    </tr>
                </tfoot>
                </table>
            </div>
            </div>
        </div>
    </main>  
</div>
@endsection
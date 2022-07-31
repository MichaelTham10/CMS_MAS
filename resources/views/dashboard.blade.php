
<style>
    hr.new5 
    {
        border: 2px solid;
        border-radius: 5px;
    }

</style>
@extends('layouts.app')

@section('head-title')
    Dashboard
@endsection

@section('page-title')
    Dashboard
@endsection

@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/dashboard.css') }}">
    @include('layouts.headers.cards')
    @php
        $totalItemInvoice = 0;
        $totalItemInvoicePO = 0;
        $totalItemAllInvoice = 0;
        $totalItemQuotation = 0;
        $totalItemPurchase = 0;
        $totalQuotation = 0;
        $totalInvoice = 0;
        $totalPurchase = 0;
        $totalInvoicePO = 0;
    @endphp
    <div class="container-fluid" >
        <div class="d-flex  mt-4 border rounded p-2 align-self-center" style="background-color: #fff">
            <div>
                <img src="{{asset('assets/img/icon/scroll.svg')}}" alt="" style="width: 60px">
            </div>
            <div class="d-flex justify-content-between w-100 align-self-center">
                <div class="pl-3">
                    <div class="opacity-5 font-weight-bold">
                        Total Quotation
                    </div>
                    <div class="font-weight-bold display-4">
                        @foreach ($quotations as $quotation)
                            @php
                                $totalQuotation = 0;
                            @endphp

                            @foreach ($quotation->items as $item)
                                @php
                                    $totalQuotation += $item['unit price'] * $item->quantity;
                                @endphp
                            @endforeach

                            @php
                                if($totalQuotation > 0 && $totalQuotation - ($totalQuotation*($quotation->Discount/100)) > 0)
                                    $totalItemQuotation += $totalQuotation - ($totalQuotation*($quotation->Discount/100));
                            @endphp
                        @endforeach
                        Rp. {{number_format($totalItemQuotation)}}.-
                    </div>
                </div>
                <div class="align-self-center">
                    <a href="{{route('quotation')}}" class="btn btn-primary ">View Details</a>
                </div>
            </div>
        </div>

        <div class="d-flex mt-4 border rounded p-2 align-self-center" style="background-color: #fff">
            <div>
                <img src="{{asset('assets/img/icon/po.png')}}" alt="" style="width: 60px">
            </div>
            <div id="wrapperInvoice" style="width: 100%; height: 63px;">
                <div class="d-flex justify-content-between w-100 align-self-center" style=" height: 63px;">
                    <div class="pl-3">
                        <div class="opacity-5 font-weight-bold">
                            Invoices
                        </div>
                        <div class="font-weight-bold display-4">
                            <div class="font-weight-bold display-4">
                                @php
                                    $totalItemInvoicePO = 0;
                                    $totalItemInvoice = 0;
                                @endphp
                                @foreach ($invoice_pos as $invoice)
                                    @php
                                        $totalInvoicePO = 0;
                                    @endphp
        
                                    @foreach ($invoice->poin->items as $item)
                                        @php
                                            $totalInvoicePO += $item['price'] * $item->quantity;
                                        @endphp
                                    @endforeach
        
                                    @php
                                        if (!$invoice->poin->items->isEmpty() || $totalInvoicePO > 0)
                                            $totalItemInvoicePO += $totalInvoicePO + $invoice->service_cost + ($totalInvoicePO * (11/100));
                                    @endphp
                                @endforeach
                                @foreach ($invoices as $invoice)
                                    @php
                                        $totalInvoice = 0;
                                    @endphp
        
                                    @foreach ($invoice->quotation->items as $item)
                                        @php
                                            $totalInvoice += $item['unit price'] * $item->quantity;
                                        @endphp
                                    @endforeach
        
                                    @php
                                        if($totalInvoice - ($totalInvoice*($invoice->quotation->Discount/100)) > 0)
                                            $totalItemInvoice += $totalInvoice - ($totalInvoice*($invoice->quotation->Discount/100));
                                    @endphp
                                @endforeach
                                Rp. {{number_format($totalItemInvoicePO + $totalItemInvoice)}}.-
                            </div>
                        </div>
                    </div>
                    <div class="align-self-center" >
                        <button class="btn btn-primary" style="border: none; width: 128.56px; height: 43px;" onclick="invoiceFunction()"> View Invoice</button>
                    </div>
                </div>
                <div class="m-2" id="myInvoice" style="display: none">
                    <div class="d-flex border rounded p-2 align-self-center justify-content-between" style="background-color: #fff; margin-top: 25px">
                        <div class="pl-3">
                            <div class="opacity-5 font-weight-bold">
                                Invoice PO In
                            </div>
                            <div class="font-weight-bold display-4">
                                Rp. {{number_format($totalItemInvoicePO)}}.-
                            </div>
                        </div>
                        <div class="align-self-center">
                            <a href="invoice/po" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                    <br>
                    <div class="d-flex border rounded p-2 align-self-center justify-content-between" style="background-color: #fff">
                        <div class="pl-3">
                            <div class="opacity-5 font-weight-bold">
                                Invoice Quotation
                            </div>
                            <div class="font-weight-bold display-4">
                                Rp. {{number_format($totalItemInvoice)}}.-
                            </div>
                        </div>
                        <div class="align-self-center">
                            <a href="/invoice" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex mt-4 border rounded p-2 align-self-center" style="background-color: #fff">
            <div>
                <img src="{{asset('assets/img/icon/po.png')}}" alt="" style="width: 60px">
            </div>
            <div id="wrapperPo" style="width: 100%; height: 63px;">
                <div class="d-flex justify-content-between w-100 align-self-center" style=" height: 63px;">
                    <div class="pl-3">
                        <div class="opacity-5 font-weight-bold">
                            Total Purchase Order
                        </div>
                        <div class="font-weight-bold display-4">
                            <div class="font-weight-bold display-4">
                                @php
                                    $totalPurchaseInItem = 0;
                                    $totalPurchaseOutItem = 0;
                                @endphp
                                @foreach ($po_ins as $po_in)     
                                    @php
                                        $totalPurchaseIn = 0;
                                    @endphp

                                    @foreach ($po_in->items as $item)
                                        @php
                                            $totalPurchaseIn += $item['price'] * $item->quantity;
                                        @endphp
                                    @endforeach
        
                                    @php
                                        if($totalPurchaseIn > 0)
                                            $totalPurchaseInItem += $totalPurchaseIn;
                                    @endphp
                                @endforeach
                                @foreach ($po_outs as $po_out)
                                    @php
                                        $totalPurchaseOut = 0;
                                    @endphp
        
                                    @foreach ($po_out->items as $item)
                                        @php
                                            $totalPurchaseOut += $item['price'] * $item->qty;
                                        @endphp
                                    @endforeach
        
                                    @php
                                        if($totalPurchaseOut > 0)
                                            $totalPurchaseOutItem += $totalPurchaseOut + ($totalPurchaseOut*($po_out->ppn/100));
                                    @endphp
                                @endforeach
                                Rp. {{number_format($totalPurchaseOutItem + $totalPurchaseInItem)}}.-
                            </div>
                        </div>
                    </div>
                    <div class="align-self-center" >
                        <button class="btn btn-primary" style="border: none; width: 128.56px; height: 43px;" onclick="myFunction()"> View PO</button>
                    </div>
                </div>
                <div class="m-2" id="myPO" style="display: none">
                    <div class="d-flex border rounded p-2 align-self-center justify-content-between" style="background-color: #fff; margin-top: 25px">
                        <div class="pl-3">
                            <div class="opacity-5 font-weight-bold">
                                Purchase In Order
                            </div>
                            <div class="font-weight-bold display-4">
                                Rp. {{number_format($totalPurchaseInItem)}}.-
                            </div>
                        </div>
                        <div class="align-self-center">
                            <a href="/po_in" class="btn btn-primary ">View Details</a>
                        </div>
                    </div>
                    <br>
                    <div class="d-flex border rounded p-2 align-self-center justify-content-between" style="background-color: #fff">
                        <div class="pl-3">
                            <div class="opacity-5 font-weight-bold">
                                Purchase Out Order
                            </div>
                            <div class="font-weight-bold display-4">
                                Rp. {{number_format($totalPurchaseOutItem)}}.-
                            </div>
                        </div>
                        <div class="align-self-center">
                            <a href="{{route('po-out')}}" class="btn btn-primary ">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush

<script type="text/javascript">
    function myFunction() 
    {
        var btn_po = document.getElementById("myPO");
        var wrapper_po = document.getElementById("wrapperPo");
        if (btn_po.style.display === "none") {
            btn_po.style.display = "block";
            wrapper_po.style.height = "100%";
        } else {
            btn_po.style.display = "none";
            wrapper_po.style.height = "63px";
        }
    }

    function invoiceFunction() 
    {
        var btn_invoice = document.getElementById("myInvoice");
        var wrapper_invoice = document.getElementById("wrapperInvoice");
        if (btn_invoice.style.display === "none") {
            btn_invoice.style.display = "block";
            wrapper_invoice.style.height = "100%";
        } else {
            btn_invoice.style.display = "none";
            wrapper_invoice.style.height = "63px";
        }
    }
</script>

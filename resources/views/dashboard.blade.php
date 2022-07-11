
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
        $totalItemQuotation = 0;
        $totalQuotation = 0;
        $totalInvoice = 0;
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
                            if($totalQuotation - $quotation->Discount > 0)
                            {
                                $totalItemQuotation += $totalQuotation - $quotation->Discount;
                            }
                                
                            @endphp
                        @endforeach
                        IDR. {{$totalItemQuotation}}.-
                    </div>
                </div>
                <div class="align-self-center">
                    <a href="{{route('quotation')}}" class="btn btn-primary ">View Details</a>
                </div>
            </div>
        </div>
        <div class="d-flex  mt-4 border rounded p-2 align-self-center" style="background-color: #fff">
            <div>
                <img src="{{asset('assets/img/icon/invoice.svg')}}" alt="" style="width: 60px">
            </div>
            <div class="d-flex justify-content-between w-100 align-self-center">
                <div class="pl-3">
                    <div class="opacity-5 font-weight-bold">
                        Total Invoice
                    </div>
                    <div class="font-weight-bold display-4">

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
                            if($totalInvoice - $invoice->quotation->Discount > 0)
                            {
                                $totalItemInvoice += $totalInvoice - $invoice->quotation->Discount;
                            }
                                
                            @endphp
                        @endforeach


                        IDR. {{$totalItemInvoice}}.-
                    </div>
                </div>
                <div class="align-self-center" >
                    <a href="{{route('invoice')}}" class="btn btn-primary ">View Details</a>
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
                            Purchase Order
                        </div>
                        <div class="font-weight-bold display-4">
    
                            {{-- @foreach ($invoices as $invoice)
                                @php
                                    $totalInvoice = 0;
                                @endphp
    
                                @foreach ($invoice->quotation->items as $item)
                            
                                    @php
    
                                        $totalInvoice += $item['unit price'] * $item->quantity;
    
                                    @endphp
    
                                @endforeach
    
                                @php
                                if($totalInvoice - $invoice->quotation->Discount > 0)
                                {
                                    $totalItemInvoice += $totalInvoice - $invoice->quotation->Discount;
                                }
                                    
                                @endphp
                            @endforeach
                            IDR. {{$totalItemInvoice}}.- --}}
                        </div>
                    </div>
                    <div class="align-self-center" >
                        <button class="btn btn-primary" style="border: none; width: 128.56px; height: 43px;" onclick="myFunction()"> View PO</button>
                    </div>
                </div>
                <div class="m-2" id="myPO" style="display: none">
                    <hr class="new5 mt-3 mb-3">
                    <div class="d-flex border rounded p-2 align-self-center justify-content-between" style="background-color: #fff; margin-top: 25px">
                        <div class="pl-3">
                            <div class="opacity-5 font-weight-bold">
                                Order Masuk
                            </div>
                            <div class="font-weight-bold display-4">
                                IDR. {{$totalItemInvoice}}.-
                            </div>
                        </div>
                        <div class="align-self-center">
                            <a href="{{route('quotation')}}" class="btn btn-primary ">View Details</a>
                        </div>
                    </div>
                    <br>
                    <div class="d-flex border rounded p-2 align-self-center justify-content-between" style="background-color: #fff">
                        <div class="pl-3">
                            <div class="opacity-5 font-weight-bold">
                                Order Keluar
                            </div>
                            <div class="font-weight-bold display-4">
                                IDR. {{$totalItemInvoice}}.-
                            </div>
                        </div>
                        <div class="align-self-center">
                            <a href="{{route('quotation')}}" class="btn btn-primary ">View Details</a>
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
</script>

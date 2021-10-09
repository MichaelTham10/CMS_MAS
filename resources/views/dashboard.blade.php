@extends('layouts.app')

@section('head-title')
    Dashboard
@endsection

@section('page-title')
    Dashboard
@endsection

@section('content')
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
        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush
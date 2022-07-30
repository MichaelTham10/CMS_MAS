
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>{{$po_out['po_out_no']}}</title>
  @php
      $total = 0;
      $ppn = 0; 
      $discount = 0;
  @endphp
  
  <style>
    *{
      font-family: 'Times New Roman', Times, serif;
      font-size: 11.5px;
    }
    .table {
      font-family: 'Times New Roman', Times, serif;
      padding: 0;
      margin: 0;
      border-collapse: collapse;
      width: 100%;
    }
    
    th {
      background-color: #c7c7c7;
      color: white;
    }
    
    .table th {
      text-align: left;
      color: black;
    }
    
    th, td {
      border-top: 1px solid black;
      font-size: 11.5px;
    }
  
    td{
      padding-top: -50px;
      margin-top: -50px;
    }
  
    .title{
      padding: 1px;
      text-align: center;
      font-weight: bold;
    }
    
    .break-word{
      word-wrap: break-word;
    }
  
    .tab0 {
        display: inline-block;
        margin-left: 53.4px;
    }
    .tab1 {
        display: inline-block;
        margin-left: 58px;
    }
    .tab2 {
        display: inline-block;
        margin-left: 27px;
    }
    .tab3 {
        display: inline-block;
        margin-left: 35px;
    }
    .tab4 {
        display: inline-block;
        margin-left: 25px;
    }
    .tab5 {
        display: inline-block;
        margin-left: 12px;
    }
    p {
      padding: 0;
      margin: 0;
      font-size: 11.5px;
    }
  
    .pding{
      padding-top: 15px;
    }
  
    .border-total
    {
      border-top: 2px solid black;
    }
    .footer-pdf
    {
      position: absolute;
      width: 100rem;
      height: 1.8rem;
      background-color: rgb(8, 4, 75);
      bottom: -45px;
      left: -30rem;
    }
    .location-mail
    {
      position: absolute;
      bottom: -15px;
      font-size: 10px;
    }
  </style>
</head>
<body>
  <div style="position: fixed; left:170px">
    <img src="assets/img/brand/logo.png" style="width: 800px; opacity: 0.3; margin-top: 63%;">
  </div>
  <div style="position: fixed; bottom: -45px" class="footer-pdf">
    <div class="footer-pdf">
    </div>
  </div>
  <div style="position: fixed;" class="location-mail">
    <div>
      Head Office : <br>
      88 Kasablanka Office Tower, Lt. 10 Unit E Jakarta | www.makroalphasolusindo.com
    </div>
  </div>
  <img src="assets/img/brand/logo.png" alt="image" style="width: 150px;" loading="lazy">
  <div>
    <div class="title" style=""> 
      <u>PURCHASE ORDER</u>
    </div>
    <div style="">
      <div style="width: 100%; font-size: 11.5px; margin-top: 20px;">
        <span>
          <strong>Number</strong><span class="break-word"  style="display: inline-block; margin-left: 40px;"></span>: {{$po_out['po_out_no']}} <br> 
        </span>
        <span>
          <strong>Date</strong><span class="break-word"  style="display: inline-block; margin-left: 58px;"></span>: {{$po_out['date']}}<br>
        </span>
        <span>
          <strong>Arrival</strong><span class="break-word" style="display: inline-block; margin-left: 44px;"></span>: {{$po_out['arrival']}}<br>
        </span>
      </div>
      <div style="font-size: 11.5px; width: 100%;">
        <span>
          <strong>To</strong><span class="break-word" style="display: inline-block; margin-left: 67px;"></span>: {{$po_out['to']}} <br>
        </span>
        <span class="break-word">
          <strong>Attn</strong><span class="break-word" style="display: inline-block; margin-left: 58px;"></span>: {{$po_out['attn']}}  <br>
        </span>
        <span>
          <strong>Email</strong><span class="break-word" style="display: inline-block; margin-left: 51px;"></span>: <a style="color: blue"><u>{{$po_out['email']}}</u></a><br>
        </span> 
      </div>
    </div>  
    <table class="table" style="margin-top: 20px; table-layout: fixed;">
      <thead>
        <tr>
          <th scope="col" style="width:6%; text-align: center;
          vertical-align: middle;"><strong>No</strong></th>
          <th scope="col" style="width:49%;"><strong>Item Description</strong></th>
          <th scope="col" style="width:15%; text-align: center;
          vertical-align: middle;"><strong>Qty</strong></th>
          <th scope="col" style="width:15%;"><strong>Unit Price</strong></th>
          <th scope="col" style="width:15%;"><strong>Total Price</strong></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($po_out->items as $item)
        <tr>
          <td class="break-word" style="width: 6%; text-align: center;
          vertical-align: middle;" scope="row">{{$loop->iteration}}</td>
          <td class="break-word" style="width: 49%,">{!!$item->item_description!!}</td>
          <td class="break-word" style="width: 15%; text-align: center;
          vertical-align: middle;">{{number_format($item->qty)}}</td>
          <td class="break-word" style="width:15%;">Rp. {{number_format($item['price'])}}</td>
          <td class="break-word" style="width:15%;">Rp. {{number_format($item['price'] * $item->qty)}}</td>
        </tr>
        @php
          $total += ($item['price'] * $item->qty);
        @endphp
        @endforeach
      </tbody>
    </table>
    @php
        $ppn = (($total / 100) * $po_out->ppn);
        // $discount = ($total/100);
    @endphp
    <br>
    <div class="table-responsive" style="font-weight: bold">
      <div class="table-responsive">
        <table class="table table-bordered no-margin table-sm">
          <tr>
            <th colspan="2" style="width: 38rem; background-color: rgb(254, 254, 120); padding-left: 2%" class="border-total" scope="row">Total</th>
            <td style="background-color: rgb(254, 254, 120); width:15%;" class="border-total">IDR. {{number_format($total)}},-</td>
          </tr>
          <tr>
            <th colspan="2" style="background-color: rgb(170, 240, 193); padding-left: 2%" class="border-total" scope="row">Ppn (11%)</th>
            <td style="background-color: rgb(170, 240, 193); width:15%;" class="border-total break-word">IDR. {{number_format($ppn)}},-</td>
          </tr>
          <tr>
            <th colspan="2" scope="row" style="background-color: rgb(254, 254, 120); border-bottom: 2px solid black; border-top: 2px solid black; padding-left: 2%">Grand Total</th>
            <td class="border-total" style="border-bottom: 2px solid black; background-color: rgb(254, 254, 120); font-weight: bold; width:15%;">IDR. {{number_format(($total + $ppn))}},-</td>
          </tr>
        </table>
      </div>
    </div>
    <br>
    <p><u><b>Terms and Condition:</b></u></p>
    <div class="break-word" style="padding-bottom: 20px;">
      {!!$po_out['terms']!!}
    </div>
    <div style="display: block; text-align: left">
      <p>Jakarta, {{ date('F d Y') }}</p>
      <br><br><br><br>
      <p><u><b>Wika Handayani</b></u></p>
      <p><b>PT Makro Alpha Solusindo</b></p>
    </div>
  </div>  

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>{{$invoice['Invoice No']}}</title>
  @php
      $total = 0;
      $ppn = 0; 
      $discount = 0;
  @endphp
  
  <style>
  *{
    font-family: 'Times New Roman', Times, serif;
  }
  .info{
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
    color: white;
  }
  
  .table th {
    border-top: 2px solid black;
    border-bottom: 2px solid black;
    text-align: left;
    color: black;
  }
  
  th, td {
    border-top: 2px solid black;
    font-size: 11.5px;
  }

  td{
    padding-top: -50px;
    margin-top: -50px;
  }

  .title{
    display: flex;
    padding: 2px;
    text-align: center;
    font-size: 18px;
    font-weight: bold;
    text-decoration-line: underline
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
      margin-left: 45px;
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
      margin-left: 55.5px;
  }
  .tab6 {
      display: inline-block;
      margin-left: 48px;
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
    <img src="assets/img/brand/logo.png" style="width: 800px; opacity: 0.3; margin-top: 60.5%;">
  </div>
  <div style="position: fixed; bottom: -45px" class="footer-pdf">
    <div class="footer-pdf">
    </div>
  </div>
  <div style="position: fixed; padding-bottom: 10px" class="location-mail">
    <div>
      Head Office : <br>
      88 Kasablanka Office Tower, Lt. 10 Unit E Jakarta | www.makroalphasolusindo.com
    </div>
  </div>
  
</div>
<img src="assets/img/brand/logo.png" alt="image" style="width: 150px;" loading="lazy">
<div>
    <div class="title"> 
      <u>INVOICE</u>
    </div>
    <div class="info" style="">
      <div style="float: left; width: 50%; font-weight: 700">
        <span>
          Bill To<span class="tab0  break-word"></span>: {{$invoice['Bill To']}} <br> 
        </span>
        <span>
          Address<span class="tab1  break-word"></span>: {{$invoice['Address']}}<br>
        </span>
      </div>
      <div style="padding-left: 450px; width: 50%; font-weight: 700">
        <span class="break-word">
          Invoice No<span class="break-word" style="display: inline-block; margin-left: 52px;"></span>: {{$invoice['Invoice No']}}  <br>
        </span>
        <span>
          Invoice Date<span class="break-word" style="display: inline-block; margin-left: 41px;"></span>: {{date("d/m/y", strtotime($invoice['Invoice Date']))  }} <br>
        </span>
        <span>
          Quotation No<span class="break-word" style="display: inline-block; margin-left: 35px;"></span>: {{$invoice->quotation['Quotation_No']}} <br>
        </span>
        <span>
          Quotation Date<span class="break-word" style="display: inline-block; margin-left: 24px;"></span>: {{date("d/m/y", strtotime($invoice->quotation['Quotation Date']))}} <br>
        </span>
      </div>
    </div>  
    <table class="table" style="margin-top: 20px; table-layout: fixed;">
      <thead style="background-color: #d1d4d3">
        <tr>
          <th scope="col" style=" text-align: center;
          vertical-align: middle;"><strong>No</strong></th>
          <th scope="col" style="width: 15%; text-align: center;"><strong>Item</strong></th>
          <th scope="col" style="text-align: center;"><strong>Description</strong></th>
          <th scope="col" style="width: 15%; text-align: center;
          vertical-align: middle;"><strong>Qty</strong></th>
          <th scope="col" style="width: 15%; "><strong>Price / Qty (IDR)</strong></th>
          <th scope="col" style="text-align: center; "><strong>Total Price (IDR)</strong></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($invoice->items($invoice['Quotation No']) as $item)
          <tr>
            <td class="break-word" style="width: 6%; text-align: center;
            vertical-align: middle;" scope="row">{{$loop->iteration}}</td>
            <td class="break-word"  style="text-align: center">{{$item->name}}</td>
            <td class="break-word" style="">{!!$item->description!!}</td>
            <td class="break-word" style=" text-align: center;
            vertical-align: middle;">{{number_format($item->quantity)}}</td>
            @if ($item['unit price'] > 0)
              <td class="break-word" style="width:15%;">IDR. {{number_format($item['unit price'])}},-</td>
            @else
              <td class="break-word" style="width:15%;">FREE</td>
            @endif
            @if ($item['unit price'] * $item->quantity > 0)
              <td class="break-word" style="width:15%;">IDR. {{number_format($item['unit price'] * $item->quantity)}},-</td>
            @else
              <td class="break-word" style="width:15%;">FREE</td>
            @endif   
          </tr>
          @php
            $total += ($item['unit price'] * $item->quantity);
          @endphp
        @endforeach
      </tbody>
    </table>
    @php
        $ppn = (($total / 100) * 11);
        $dp = 0;
    @endphp
    <br>
    <div class="table-responsive">
      <div class="table-responsive m-10">
        <table class="table table-bordered no-margin table-sm" style="background-color: #d1d4d3">
          <tr>
            <th colspan="2" style="width: 38rem; padding-left: 2%" class="border-total" scope="row">Subtotal (IDR)</th>
            <td  class="border-total break-word "style="text-align: right; font-weight: bold; width:15%;">{{number_format($total)}}.-</td>
          </tr>
          <tr>
            <th colspan="2" style="padding-left: 2%"  scope="row">Discount</th>
            <td  class="border-total break-word "style="text-align: right; font-weight: bold; width:15%;">{{number_format((($total / 100) * $invoice->quotation->Discount))}}.-</td>
          </tr>
          @if($invoice->payment_status != "Down Payment")
            @foreach ($invoice_dps as $invoice_dp)
              <tr>
                <th colspan="2" style="padding-left: 2%"  scope="row">{{$invoice_dp->addOrdinalNumberSuffix($loop->iteration)}} Payment</th>
                <td  class="border-total break-word "style="text-align: right; font-weight: bold; width:15%;">{{number_format(($total + $ppn - (($total / 100) * $invoice->quotation->Discount)) * ($invoice_dp->dp_percent/100))}}</td>
              </tr>
              @php
                $dp += ($total + $ppn - (($total / 100) * $invoice->quotation->Discount)) * ($invoice_dp->dp_percent/100);
              @endphp
            @endforeach
          @else
            <tr>
              <th colspan="2" style="padding-left: 2%"  scope="row">DP ({{$invoice->dp_percent}} %)</th>
              <td  class="border-total break-word "style="text-align: right; font-weight: bold; width:15%;">{{number_format(($total + $ppn - (($total / 100) * $invoice->quotation->Discount)) * ($invoice->dp_percent/100))}}</td>
            </tr>
            @php
              $dp += ($total + $ppn - (($total / 100) * $invoice->quotation->Discount)) * ($invoice->dp_percent/100);
            @endphp
          @endif
          <tr>
            <th colspan="2" style="padding-left: 2%;" class="border-total" scope="row">Ppn (11%)</th>
            <td  class="border-total break-word; " style="text-align: right; font-weight: bold; width:15%;">{{number_format($ppn)}}.-</td>
          </tr>
          <tr>
            <th colspan="2" scope="row" style="padding-left: 2%;">Grand Total</th>
            <td class="border-total" style="border-bottom: 2px solid black;text-align: right;font-weight: bold; width:15%;">{{number_format(($total + $ppn - (($total / 100) * $invoice->quotation->Discount)) - $dp)}}.-</td>
          </tr>
        </table>
      </div>
    </div>
    <br>
    <p><b>Note:</b></p>
    <div class="break-word" style="">
      {!!$invoice['Note']!!}
    </div>
    <br>
    <div style="display: block">
      <p><strong>Jakarta, {{ date('F d,Y') }}</strong></p>
      <br>
      <br>
      <br>
      <br>
      <p><u><b>Wika Handayani</b></u></p>
      <p><b>PT Makro Alpha Solusindo</b></p>
    </div>
</div> 
</body> 

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>{{$quotation['Quotation_No']}}</title>
  @php
      $total = 0;
      $ppn = 0; 
      $discount = 0;
  @endphp
  
  <style>
  *{
    font-family: Arial, Helvetica, sans-serif;
  }
  .table {
  font-family: Arial, Helvetica, sans-serif;
  padding: 0;
  margin: 0;
  border-collapse: collapse;
  width: 100%;
  }
  
  th {
    background-color: rgb(118, 166, 221);
    color: white;
  }
  
  .table th {
    padding-top: 6px;
    padding-bottom: 6px;
    text-align: left;
    color: black;
  }
  
  th, td {
    border-top: 1px solid black;
    font-size: 12px;
  }

  td{
    padding-top: -50px;
    margin-top: -50px;
  }

  .title{
    display: flex;
    padding: 2px;
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
    font-size: 12px;
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
  <div style="position: fixed; padding-bottom: 10px" class="location-mail">
    <div>
      Head Office : <br>
      88 Kasablanka Office Tower, Lt. 10 Unit E Jakarta | www.makroalphasolusindo.com
    </div>
  </div>
  </div>
  <img src="assets/img/brand/logo.png" alt="image" style="width: 150px; margin-bottom: -20px; margin-top: 20px;" loading="lazy">
  <div>
    <div class="title" style="margin-top: 20px;"> 
      QUOTATION
    </div>
    <div style="">
      <div style="float: left; width: 50%; font-size: 12px; margin-top: 20px;">
        <span>
          Customer<span class="tab0  break-word"></span>: {{$quotation['Customer']}} <br> 
        </span>
        <span>
          Attention<span class="tab1  break-word"></span>: {{$quotation['Attention']}}<br>
        </span>
        <span>
          Payment Term<span class="tab2  break-word"></span>: {{$quotation['Payment Term']}}<br>
        </span>
      </div>
      <div style="padding-left: 450px; font-size: 12 px; width: 50%; margin-top: 20px;">
        <span class="break-word">
          Quotation No<span class="tab3 break-word"></span>: {{$quotation->getFormatId($quotation->type_id,$quotation->type_detail_quantity, $quotation['Quotation Date'])}} <br>
        </span>
        <span>
          Quotation Date<span class="tab4 break-word"></span>: {{$quotation['Quotation Date']}} <br>
        </span>
        <span>
          Account Manager<span class="tab5 break-word"></span>: {{$quotation['Account Manager']}}<br>
        </span>
      </div>
    </div>
    
    <table class="table" style="margin-top: 20px; table-layout: fixed;">
      <thead>
        <tr>
          <th scope="col" style="width:6%; text-align: center;
          vertical-align: middle;"><strong>No</strong></th>
          <th scope="col" style="width:18%;"><strong>Name</strong></th>
          <th scope="col" style="width:42%;"><strong>Description</strong></th>
          <th scope="col" style="width:15%; text-align: center;
          vertical-align: middle;"><strong>Qty</strong></th>
          <th scope="col" style="width:20%;"><strong>Unit Price</strong></th>
          <th scope="col" style="width:20%;"><strong>Total Price</strong></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($quotation->items as $item)
          <tr>
            <td class="break-word" style="width:6%; text-align: center;
            vertical-align: middle;" scope="row">{{$loop->iteration}}</td>
            <td class="break-word" style="width:18%;">{{$item->name}}</td>
            <td class="break-word" style="width:42%;">{!!$item->description!!}</td>
            <td class="break-word" style="width:15%; text-align: center;
            vertical-align: middle;">{{$item->quantity}}</td>
            <td class="break-word" style="width:20%;">Rp. {{number_format($item['unit price'])}}</td>
            <td class="break-word" style="width:20%;">Rp. {{number_format($item['unit price'] * $item->quantity)}}</td>
          </tr>
        @php
          $total += ($item['unit price'] * $item->quantity);
        @endphp
        @endforeach
      </tbody>
    </table>
    @php
        $ppn = (($total / 100) * 11);
        // $discount = ($total/100) * $quotation['Discount'];
    @endphp
    <br>
    <div class="table-responsive">
      <div class="table-responsive">
        <table class="table table-bordered no-margin table-sm">
          <tr>
            <th colspan="2" style="width: 31.2rem; background-color: rgb(235, 216, 131); padding-left: 2%" class="border-total" scope="row">Total</th>
            <td style="background-color: rgb(235, 216, 131);" class="border-total">Rp. {{number_format($total)}}</td>
          </tr>
          <tr>
            <th colspan="2" style="background-color: #bbbcbd; padding-left: 2%" class="border-total" scope="row">Discount</th>
            <td class="border-total" style="background-color: #bbbcbd;">Rp. {{number_format(($total/100) * $quotation['Discount'])}}</td>
          </tr>
          <tr>
            <th colspan="2" style="background-color: rgb(139, 219, 166); padding-left: 2%" class="border-total" scope="row">Ppn (11%)</th>
            <td style="background-color: rgb(139, 219, 166);" class="border-total break-word">Rp. {{number_format($ppn)}}</td>
          </tr>
          <tr>
            <th colspan="2" scope="row" style="background-color: rgb(235, 216, 131); border-bottom: 2px solid black; border-top: 2px solid black; padding-left: 2%">Grand Total</th>
            <td class="border-total" style="border-bottom: 2px solid black; background-color: rgb(235, 216, 131); font-weight: bold;">Rp. {{number_format(($total + $ppn) - ($total/100) * $quotation['Discount'])}}</td>
          </tr>
        </table>
      </div>
    </div>
    <br>
    <p><u><b>Terms and Condition:</b></u></p>
    <div class="break-word" style="padding: 10px">
      {!!$quotation['Terms']!!}
    </div>
    <br>
    <div style="display: block;">
      <p><strong>Jakarta, {{ date('M-d-Y') }}</strong></p>
      <br>
      <br>
      <br>
      <br>
      <p><u><b>Wika Handayani</b></u></p>
      <p><b>PT Makro Alpha Solusindo</b></p>
    </div>
  </div>  
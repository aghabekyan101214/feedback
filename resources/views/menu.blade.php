<!DOCTYPE html>
<html>
<head>
    <script type="text/javascript" src="{{ asset("material/js/modules/materialadmin/libs/jquery/jquery.min.js") }}"></script>
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8" />
    <title>Administrator : </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" type="text/css" href="{{ asset("material/css/bootstrap.css") }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset("material/css/font-awesome.min.css") }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset("material/css/material-design-iconic-font.min.css") }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset("material/css/font-awesome.min.css") }}" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<style>
    .nav.nav-pills{
        overflow-y: scroll;
        display: flex;
        align-items: center;
        height: 85px;
    }
    body {
        background: #f3f3f3;
    }
    .nav-pills a{
        min-width: 120px;
        width: auto;
        white-space: nowrap;
        text-align: center;
        border-radius: 8px!important;
        color: #7c7c7c;
        background: white;
        box-shadow: 1px 2px 15px #d8d7d7;
    }
    .active a{
        background: #ffc608!important;
    }
    .nav-pills li{
        margin: 5px;
    }
    .nav-cont{
        padding: 0 15px;
        box-shadow:1px 0 15px #a7a6a6;
    }
    .yellow-line{
        display: block;
        height: 12px;
        width: 30px;
        background: #ffc608;
        margin-right: 3px;
    }
    .box{
        border: 1px solid #d8d7d7;
        border-radius: 10px;
    }
    .col-xs-6{
        padding-left: 3px!important;
        padding-right: 3px!important;
    }
</style>
<body>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 nav-cont">
                <ul class="nav nav-pills">
                    @foreach($list as $bin => $l)
                        <li @if($bin == 0) class="active" @endif><a data-toggle="pill" href="#tab{{ $bin }}">{{ $l->name }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="tab-content row" style="padding-top: 10px">
            @foreach($list as $bin => $l)
                <div id="tab{{ $bin }}" class="tab-pane fade in @if($bin == 0) active @endif">
                    @foreach($l->items as $item)
                        <div class="col-xs-6" style="margin-bottom: 10px">
                            <div class="box">
                                <h4 class="text-center title" style="display: flex; align-items: center"><span class="yellow-line"></span><b>{{ $l->name }}</b></h4>
                                <div class="img-box" style="display: flex; justify-content: center">
                                    <img class="img-responsive" style="height: 70px" src="{{ asset("uploads/$item->icon") }}" alt="">
                                </div>
                                <div class="detail-box" style="padding: 0 5px">
                                    <h4 class="text-center title"><b>{{ $item->name }}</b></h4>
                                    <p class="text-center"><img style="margin: 0 5px 2px 0" src="{{ asset("images/coin.png") }}" alt="">{{ intval($item->price) }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</body>
<script type="text/javascript" src="{{ asset("material/js/modules/materialadmin/libs/bootstrap/bootstrap.min.js") }}"></script>
<script src="{{ asset("material/jquery/jquery.min.js") }}"></script>
</html>



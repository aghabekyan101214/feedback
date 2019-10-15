<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Administrator : </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href='http://fonts.googleapis.com/css?family=Roboto:300italic,400italic,300,400,500,700,900' rel='stylesheet'
          type='text/css'/>
    <link rel="stylesheet" type="text/css" href="{{ asset("material/css/bootstrap.css") }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset("material/css/materialadmin.css") }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset("material/css/font-awesome.min.css") }}"/>
    <link rel="stylesheet" type="text/css"
          href="{{ asset("material/css/material-design-iconic-font.min.css") }}"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body class="menubar-hoverable header-fixed ">

<!-- BEGIN LOGIN SECTION -->
<section class="section-account">
    <div class="img-backdrop" style="background-image: url('{{ asset("material/images/img16.jpg") }}')"></div>
    <div class="spacer"></div>
    <div class="card contain-sm style-transparent">
        <div class="card-body">
            <div class="row">
                <form action="{{ route("login") }}" method="post">
                    @csrf
                    <div class="col-sm-6">
                        <br/>
                        <span class="text-lg text-bold text-primary">{{ env("APP_NAME") }}</span>
                        <br/><br/>
                        <div class="form-group">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <input type="email" value="{{ old("email") }}" class="form-control" id="email" name="email">
                            <label for="email">Email</label>
                        </div>
                        <div class="form-group">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                            <input type="password" class="form-control" id="password"  name="password" >
                            <label for="password">Password</label>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-xs-6 text-left">
                                <div class="checkbox checkbox-inline checkbox-styled">
                                    <label>
                                        <input type="checkbox"> <span>Remember me</span>
                                    </label>
                                </div>
                            </div><!--end .col -->
                            <div class="col-xs-6 text-right">
                                <button class="btn btn-primary btn-raised" type="submit">Login</button>
                            </div><!--end .col -->
                        </div><!--end .row -->
                    </div><!--end .col -->
                </form>
            </div><!--end .row -->
        </div><!--end .card-body -->
    </div><!--end .card -->
</section>
<!-- END LOGIN SECTION -->



<script type="text/javascript"
        src="{{ asset("material/js/modules/materialadmin/libs/jquery/jquery.min.js") }}"></script>
<script type="text/javascript"
        src="{{ asset("material/js/modules/materialadmin/libs/jquery/jquery-migrate-1.2.1.min.js") }}"></script>
<script type="text/javascript"
        src="{{ asset("material/js/modules/materialadmin/libs/bootstrap/bootstrap.min.js") }}"></script>
<script type="text/javascript"
        src="{{ asset("material/js/modules/materialadmin/libs/spin.js/spin.min.js") }}"></script>
<script type="text/javascript"
        src="{{ asset("material/js/modules/materialadmin/libs/autosize/jquery.autosize.min.js") }}"></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nanoscroller/0.8.7/javascripts/jquery.nanoscroller.js"></script>
<script type="text/javascript"
        src="{{ asset("material/js/modules/materialadmin/core/cache/63d0445130d69b2868a8d28c93309746.js") }}"></script>
<script type="text/javascript"
        src="{{ asset("material/js/modules/materialadmin/core/demo/Demo.js") }}"></script>


</body>
</html>

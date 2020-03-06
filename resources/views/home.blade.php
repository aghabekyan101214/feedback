@extends('layouts.app')

@section('content')
    <style>
        .card{
            cursor: pointer;
            position: relative;
            height: 230px;
            width: 280px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        .layer{
            position: absolute;
            height: 100%;
            width: 100%;
            background: #ffc60a66;
        }
        .title{
            color: white;
            position: relative;
            z-index: 10;
        }
        .cont{
            overflow: hidden;
        }
    </style>
    <div class="row">
        <div class="col-md-12">
            <h1>Main Dashboard</h1>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row">

                <div class="col-md-3 cont">
                    <div class="card" onclick="document.getElementById('pos').click()" style="background: url('{{ asset("images/pos.jpg") }}')">
                        <h1 class="text-center title">P.O.S</h1>
                        <div class="layer"></div>
                        <a href="/admin/pos" id="pos"></a>
                    </div>
                </div>

                <div class="col-md-3 cont">
                    <div class="card" onclick="document.getElementById('feedback').click()" style="background: url('{{ asset("images/feedback.jpg") }}')">
                        <h1 class="text-center title">FEEDBACK</h1>
                        <div class="layer"></div>
                        <a href="/admin/feedback/questions" id="feedback"></a>
                    </div>
                </div>

                <div class="col-md-3 cont">
                    <div class="card" onclick="document.getElementById('reservation').click()" style="background: url('{{ asset("images/reservation.jpg") }}')">
                        <h1 class="text-center title">RESERVATIONS</h1>
                        <div class="layer"></div>
                        <a href="/admin/reservations" id="reservation"></a>
                    </div>
                </div>

                <div class="col-md-3 cont">
                    <div class="card" onclick="document.getElementById('inventory').click()" style="background: url('{{ asset("images/inventory.jpg") }}')">
                        <h1 class="text-center title">INVENTORY</h1>
                        <div class="layer"></div>
                        <a href="/admin/inventory" id="inventory"></a>
                    </div>
                </div>


            </div>
            <hr>
        </div>
    </div>
@endsection

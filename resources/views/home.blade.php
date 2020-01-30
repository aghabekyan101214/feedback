@extends('layouts.app')

@section('content')
    <style>
        .card{
            cursor: pointer;
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

                <div class="col-md-2">
                    <div class="card" onclick="document.getElementById('pos').click()">
                        <div class="card-body">
                            <h3 class="card-title">P.O.S</h3>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="/admin/pos" id="pos" class="btn btn-primary">Open</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="card" onclick="document.getElementById('feedback').click()">
                        <div class="card-body">
                            <h3 class="card-title">Customer Feedback</h3>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="/admin/feedback/questions" id="feedback" class="btn btn-primary">Open</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="card" onclick="document.getElementById('reservations').click()">
                        <div class="card-body">
                            <h3 class="card-title">Reservations</h3>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="/admin/reservations" id="reservations" class="btn btn-primary">Open</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="card" onclick="document.getElementById('inventory').click()">
                        <div class="card-body">
                            <h3 class="card-title">Inventory</h3>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="/admin/inventory" id="inventory" class="btn btn-primary">Open</a>
                        </div>
                    </div>
                </div>

            </div>
            <hr>
        </div>
    </div>
@endsection

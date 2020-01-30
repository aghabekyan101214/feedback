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
                    <div class="card" onclick="document.getElementById('orders').click()">
                        <div class="card-body">
                            <h3 class="card-title">Orders</h3>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="/admin/pos/orders" id="orders" class="btn btn-primary">Open</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="card" onclick="document.getElementById('categories').click()">
                        <div class="card-body">
                            <h3 class="card-title">Food Categories</h3>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="/admin/pos/categories" id="categories" class="btn btn-primary">Open</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="card" onclick="document.getElementById('items').click()">
                        <div class="card-body">
                            <h3 class="card-title">Food Items</h3>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="/admin/pos/items" id="items" class="btn btn-primary">Open</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="card" onclick="document.getElementById('tables').click()">
                        <div class="card-body">
                            <h3 class="card-title">Tables</h3>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="/admin/pos/tables" id="tables" class="btn btn-primary">Open</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="card" onclick="document.getElementById('floors').click()">
                        <div class="card-body">
                            <h3 class="card-title">Floors</h3>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="/admin/pos/floors" id="floors" class="btn btn-primary">Open</a>
                        </div>
                    </div>
                </div>

            </div>
            <hr>
        </div>
    </div>
@endsection

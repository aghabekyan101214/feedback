@extends("layouts.app")
@section("content")
    <style>
        .tab-content img, .table-cont {
            cursor: pointer;
        }
        .modal-header, .modal-footer{
            border: none;
        }
        .header-part{
            display: flex;
        }
        .name-cont{
            margin-left: 15px;
        }
        .item-name-modal{
            margin-top: 5px;
        }
        .current-orders{
            display: flex;
            justify-content: space-between;
            border-bottom: 1px dotted gray;
            align-items: center;
            padding-bottom: 10px;
        }
        .current-orders:first-child{
            border-top: 1px dotted gray;
        }
        .table-tab li {
            float: right;
        }

    </style>
    <div class="row">
        <div class="col-md-12">
            <div class="pull-right">
                <ul class="list-group pull-right inline-style" id="yw0">
                 </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="pull-right">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-8">

                            <div class="container-fluid">

                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#table">Tables</a></li>

                                    <li><a data-toggle="tab" href="#all">All</a></li>
                                    @foreach($categories as $bin => $c)
                                        <li><a data-toggle="tab" href="#tab{{ $bin }}">{{ $c->name }}</a></li>
                                    @endforeach
                                </ul>

                                <div class="tab-content" style="padding-top: 30px">

                                    <div id="table" class="tab-pane fade in active">
                                        <div class="row">
                                            <ul class="nav nav-tabs table-tab">
                                                @foreach($sections as $bin => $section)
                                                    <li class="@if($bin == 0) active @endif"><a data-toggle="tab" href="#tab-section-{{ $bin }}">{{ $section->name }}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="tab-content">
                                            @foreach($sections as $bin => $section)
                                                <div class="tab-pane fade @if($bin == 0) active in @endif" id="tab-section-{{ $bin }}">
                                                    <div class="row">
                                                        @foreach($section->tables as $table)
                                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3 table-cont" table="{{ $table->id }}">
                                                                <h1><span class="label label-default">{{ $table->name }}</span></h1>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
{{--                                        <div class="row">--}}
{{--                                            @foreach($tables as $table)--}}
{{--                                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3 table-cont" table="{{ $table->id }}">--}}
{{--                                                    <h1><span class="label label-default">{{ $table->name }}</span></h1>--}}
{{--                                                </div>--}}
{{--                                            @endforeach--}}
{{--                                        </div>--}}
                                    </div>

                                    <div id="all" class="tab-pane fade in">
                                        <div class="row">
                                            @foreach($items as $item)
                                                <div data-toggle="modal" data-target="#myModal" onclick="orderItem('{{ $item->id }}', '{{ $item->name }}', '{{ $item->price }}', '{{ asset("uploads/$item->icon") }}', this)" quantity="1" itemId="{{ $item->id }}" price="{{ $item->price }}" class="col-md-2 text-center">
                                                    <img style="height: 150px" class="img-thumbnail" src="{{ asset("uploads/$item->icon") }}" alt="">
                                                    <h4 class="text-center name-h">{{ $item->name }}</h4>
                                                    <h4 class="text-center">{{ $item->price }} AMD</h4>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    @foreach($categories as $bin => $c)
                                        <div id="tab{{ $bin }}" class="tab-pane fade in">
                                            <div class="row">
                                                @foreach($c->items as $item)
                                                    <div data-toggle="modal" data-target="#myModal" onclick="orderItem('{{ $item->id }}', '{{ $item->name }}', '{{ $item->price }}', '{{ asset("uploads/$item->icon") }}', this)" quantity="1" itemId="{{ $item->id }}" price="{{ $item->price }}" class="col-md-2 text-center">
                                                        <img style="height: 150px" class="img-thumbnail" src="{{ asset("uploads/$item->icon") }}" alt="">
                                                        <h4 class="text-center name-h">{{ $item->name }}</h4>
                                                        <h4 class="text-center">{{ $item->price }} AMD</h4>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Modal -->
                            <div id="myModal" class="modal" role="dialog">
                                <div class="modal-dialog" style="position:relative; top: 50%; transform: translateY(-50%)">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <button style="font-size: 35px" type="button" class="close" data-dismiss="modal">&times;</button>
                                            <div class="header-part">
                                                <img class="item-img-modal" style="height: 150px" src="" alt="">
                                                <div class="name-cont">
                                                    <h3 class="item-name-modal"></h3>
                                                    <h3 class="item-price-modal"></h3>
                                                    <div class="quantity-cont">
                                                        <label class="" for="">Quantity</label>
                                                        <input type="number" class="item-quantity form-control" step="any">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="notes" style="margin-top: 20px">
                                                <label for="">Notes</label>
                                                <textarea style="border: 1px solid rgba(12, 12, 12, 0.12)" name="" id="" class="form-control order-detail" cols="30" rows="5"></textarea>
                                            </div>
                                            <div class="order-btn text-center" style="padding-top: 10px">
                                                <button data-dismiss="modal" class="btn btn-primary" onclick="add()">Add</button>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="col-md-4" style="border-left: 1px solid gray;">
                            <div class="order-container">
                                <h3 class="text-center table-show" style="margin-bottom: 0; padding-bottom: 5px">No Chosen Table</h3>
                                <div class="current-order-container">

                                </div>
                                <div class="total">
                                    <h3 class="text-right">Total: <span class="total-price">0</span> AMD</h3>
                                    <button class="btn btn-primary" style="width: 100%" onclick="submitOrder()"> @if($order) Update @else Submit @endif Order</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let table = [];
        let order = [];
        let item;
        let editing = false;
        let orderId = "";
        $(document).ready(function(){
            $(document).on("click", ".table-cont", function(){

                $(this).find(".label").toggleClass("label-success");
                let push = true;
                let table_id = $(this).attr('table');
                table.forEach(function(e, i){
                    if(e == table_id) {
                        table.splice(i, 1);
                        push = false;
                        return;
                    }
                });
                if(push === true) table.push($(this).attr('table'));
                let table_names = "";
                $("#table .label-success").each(function() {
                    table_names += $(this).html() + "&nbsp";
                })
                $(".table-show").html(table_names);
            });

            @if($order)
                edit(' <?= json_encode($order); ?> ', '{{ json_encode($tableId) }}');
                editing = true;
                let jsoned_tables = '{{ json_encode($tableId) }}';
                table = JSON.parse(jsoned_tables);
                orderId = '{{ $orderId }}';
            @endif
        });

        $(window).on('beforeunload', function(){
            if(order != "" && order != undefined) {
                return 'Are you sure you want to leave?';
            }
        });

        function orderItem(id, name, price, image, self) {
            let index = getItemFromOrder(id);
            console.log(order)
            let quantity = index >= 0 ? order[index].quantity : 1;
            let orderDetail = index >= 0 ? order[index].notes : " ";
            $(".item-img-modal").attr("src", image);
            $(".item-name-modal").html(name);
            $(".item-price-modal").html(price + " AMD");
            $(".item-quantity").val(quantity);
            $(".order-detail").val(orderDetail);
            item = $(self);
        }

        $(document).on("input", ".item-quantity", function(){
            let quantity = $(this).val()
            if(quantity < 1) {
                $(this).val(1);
            }
        });

        function add() {
            let itemId = item.attr("itemId");
            let quantity = $(".item-quantity").val();
            let orderDetail = $(".order-detail").val();
            let index = getItemFromOrder(itemId);
            let name = item.find(".name-h").html();
            let img = item.find("img").attr("src");
            let price = item.attr("price");
            if(index >= 0) {
                updateOrder(itemId, quantity, orderDetail, name, img, price, index);
            } else {
                addToOrder(itemId, quantity, orderDetail, name, img, price);
            }
        }

        function addToOrder(itemId, quantity, orderDetail, name, img, price) {
            order.push({
                id: itemId,
                quantity: quantity,
                name: name,
                img: img,
                price: price,
                notes: orderDetail
            });
            showOrder(order[order.length - 1]);
            countTotal()
        }

        function updateOrder(itemId, quantity, orderDetail, name, img, price, index) {
            order[index] = {
                id: itemId,
                quantity: quantity,
                name: name,
                img: img,
                price: price,
                notes: orderDetail
            }
            updateShownOrder(order[index]);
            countTotal();
        }

        function showOrder(order) {
            let html = `
            <div class="current-orders row" itemId="${order.id}">
                <div class="col-md-7">
                    <h4>${order.name}</h4>
                </div>
                <div class="col-md-1">
                    <h4 class="ordered-quantity">${order.quantity}</h4>
                </div>
                <div class="col-md-3">
                    <h4><span class="ordered-price">${order.price}</span> AMD</h4>
                </div>
                <div class="col-md-1">
                    <button class="btn btn-danger btn-sm" onclick="remove('${order.id}')"><i class="fa fa-trash"></i></button>
                </div>
            </div>
`;
            $(".current-order-container").append(html);
        }

        function updateShownOrder(order) {
            $(document).find(".current-orders").each(function(){
                if($(this).attr("itemId") == order.id) {
                    $(this).find(".ordered-quantity").html(order.quantity);
                    return;
                }
            });
        }

        function remove(itemId) {
            order.forEach(function(e, i) {
                if(e.id == itemId) {
                    order.splice(i, 1);
                    countTotal();
                    return;
                }
            });

            $(document).find(".current-orders").each(function() {
                if($(this).attr("itemId") == itemId) {
                    $(this).remove();
                    return;
                }
            });

        }

        function countTotal() {
            let sum = 0;
            order.forEach(function(e){
                sum += (e.quantity * e.price);
            });
            $(".total-price").html(sum.toFixed(2));
        }

        function getItemFromOrder(itemId) {
            return order.findIndex(item => (item.id == itemId));
        }

        function submitOrder(){
            if(confirm("Do You Really Want To Submit Order ? ") == false) {
                return;
            }
            if(table == "") {
                alert("Please, Choose a Table");
                $('.nav-tabs a[href="#table"]').tab('show');
                return;
            } else if(order == "") {
                alert("Please, Choose at Least One Order From the Menu");
                $('.nav-tabs a[href="#all"]').tab('show');
                return;
            }
            let route = !editing ? "/admin/pos/orders" : `/admin/pos/orders/update/${orderId}`;
            $.post( route, {order: order, tableId: table}, function( data ) {
                alert(data.message);
                if(data.success == true) {
                    reload();
                }
            });
        }

        function reload() {
            order = "";
            table = "";
            window.location.href = "/admin/pos/orders";
        }

        function edit(data, tableId) {
            order = JSON.parse(data);
            table = JSON.parse(tableId);
            $(".tab-pane .table-cont").each((e, i) => {
                if(table.includes(Number($(i).attr("table")))) {
                    $(i).trigger("click");
                }
            });
            order.forEach(e => {
               showOrder(e);
            });
            countTotal();
        }


    </script>
@endsection

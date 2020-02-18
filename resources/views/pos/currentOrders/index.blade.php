@extends("layouts.app")
@section("content")
    <style>
        .dataTables_filter{
            display: none;
        }
        .panel-left{
            height: 80vh;
            overflow-y: auto;
        }
    </style>

    <div class="row">
        <div class="col-md-12">
            <div class="col-md-4 panel-left" style="padding-right: 5px">
                <div class="panel-heading" style="display: flex; justify-content: space-between; align-items: center; background: #3580b5">
                    <h3 style="color: #fff">Orders</h3>
                    <button class="btn btn-default" style="color: #3580b5"><a href="/admin/pos/orders">New Order</a></button>
                </div>
                <div class="panel">
                    <table class="table table-bordered table-striped datatable2">
                        <thead>
                        <tr>
                            <th style="width: 10%">ID</th>
                            <th>Table</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Settings</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $bin => $d)
                            <tr>
                                <td>{{ -($bin - $length) }}</td>
                                <td>
                                    @foreach($d->tables as $t)
                                        {{ $t->name }}
                                    @endforeach
                                </td>
                                <td>
                                    @if($d->status == 0)
                                        <label class="label label-success">Active</label>
                                    @elseif($d->status == 1)
                                        <label class="label label-danger">Closed</label>
                                    @endif
                                </td>
                                <td>
                                    <?php $sum = 0; ?>
                                    @foreach($d->ordersList as $o)
                                        <?php $sum += $o->price * $o->quantity; ?>
                                    @endforeach
                                    {{ $sum }}
                                </td>
                                <td class="text-center">
                                    <button onclick="detail('{{ json_encode($d->ordersList) }}', this, '{{ $d->status }}')" class="btn btn-default"><i class="fa fa-gear"></i></button>
                                    @if($d->status == 0)
                                        <button data-toggle="tooltip" title="Close Order" class="btn btn-success" onclick="changeStatus('{{ $d->id }}')"><i class="fa fa-toggle-on"></i></button>
                                    @endif
                                    @if($d->status == 1)
                                        <button class="btn btn-primary"><i class="fa fa-print"></i></button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-8" style="padding-left: 5px">
                <div class="panel-heading" style="display: flex; justify-content: space-between; align-items: center; background: #3580b5">
                    <h3 style="color: #fff" class="detail-text">Order # <span class="detail-span"></span></h3>
                    <a href="#" class="href-btn">
                        <button class="btn btn-default" style="color: #3580b5">Add Item</button>
                    </a>
                </div>
                <div class="panel">
                    <table class="table table-bordered table-striped orders-detail">

                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.datatable2').DataTable( {
                "order": [[ 0, "desc" ]],
                "paging": false
            } );
        } );

        function detail(data, self, status) {
            let parsedData = JSON.parse(data);
            $(self).parentsUntil("table").find("tr").css({'outline': '0'});
            $(self).parentsUntil("tbody").not("td").css({'outline': '1px solid blue'});
            let html = `
                    <thead>
                        <tr>
                            <th>Item ID</th>
                            <th>Name</th>
                            <th>Unit Price</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Notes</th>
                        </tr>
                    </thead>
                    `;
            parsedData.forEach(e => {
               html += `
                    <tr>
                        <td>${e.item_id}</td>
                        <td>${e.items.name}</td>
                        <td>${e.price}</td>
                        <td>${e.quantity}</td>
                        <td>${e.quantity * e.price}</td>
                        <td>${e.notes != null ? e.notes : ""}</td>
                    </tr>
               `;
            });
            $(".orders-detail").html(html);
            let order_id = parsedData != "" ? parsedData[0].order_id : 0;
            $(".detail-span").html(order_id);
            let route = status == 0 ? `/admin/pos/edit-order/${order_id}` : "#";
            $(".href-btn").attr("href", route);
        }

        function changeStatus(orderId) {
            $.post( `{{ $route."/change-status/" }}${orderId}`, function( data ) {
                alert(data.message);
                if(data.success == true) {
                    location.reload();
                }
            });
        }

    </script>
@endsection

@extends('layouts.app')

@section('title')
Senimart - Checkout #{{$sales->id}}
@endsection

@section('content')
<div class="checkout">
    <div class="title-checkout">
        <h1>Checkout</h1>
        <p>Order ID: {{$sales->id}}</p>
        <hr>
    </div>
    <div class="data-input">
        <h1 class="os">Billing Address</h1>
        <div class="form-group">
            <label for="">Full Name</label>
            <input type="text" class="form-control" name="" id="" aria-describedby="helpId" value="{{$user->name}}">
        </div>
        <div class="form-group">
            <label for="">Email</label>
            <input type="text" class="form-control" name="" id="" aria-describedby="helpId" value="{{$user->email}}">
        </div>
        <div class="form-group">
            <label for="">Mobile Phone</label>
            <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="Input Phone Number">
        </div>
        <div class="form-group">
            <label for="">Address</label>
            <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="Input Address">
        </div>
        <div class="form-group">
            <label for="">Province</label>
            <select id="prov" class="form-control">
                <option value="" selected disabled>Select Province</option>
                @foreach ($provinces as $prov)
                <option value="{{$prov->province_id}}">{{$prov->province}}</option>
                @endforeach
            </select>
            {{-- <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder=""> --}}
        </div>
        <div class="form-row">
            <div class="col">
                <label for="">City</label>
                <select id="city" class="form-control">
                    <option value="" selected disabled>Select Province First</option>
                </select>
                {{-- <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder=""> --}}
            </div>
            <div class="col">
                <label for="">Zip</label>
                <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="Input Zip / Postal Code">
            </div>
        </div>
        <hr>
        <div class="form-group">
            <label for="">Shipping</label>
            <select id="ship" class="form-control">
                <option value="" selected disabled>Select Province & City First</option>
            </select>
        </div>
    </div>

    <div class="item-checkout">
        <h1 class="os">Order Summary</h1>
        @foreach ($checkoutItem->first()->artworks as $item)
        <div class="product-item">
            <div class="detail-image">
                <a href="{{route('artworks.show', $item->slug)}}"><img
                        src="{{ asset('storage/'.$item->image) }}" alt=""></a>
            </div>
            <div class="detail-text">
                <a href="{{route('artworks.show', $item->slug)}}">
                    <h2>{{$item->title}}</h2>
                </a>
                <h3>{{$item->artists->name}}</h3>
                <p>{{$item->category->name}}</p>
                <p> {{$item->sizeHeight}} (H) / {{$item->sizeWidth}} (W)</p>
            </div>
            <div class="price">
                <h2>Rp.{{$item->price}}</h2>
                <h3>Quantity : {{$item->pivot->qty}}</h3>
            </div>
        </div>
        <hr>
        @endforeach
        <div class="total">
            <h2 id="totalprice">Total Price : Rp.{{$sales->totalPrice}}</h2>
            <p id="shipcost">Shipping Cost : Rp.0</p>
        </div>
        <a class="button-black" href="">Proceed to Payment</a>
        <a href="/checkout/remove/{{$sales->id}}" class="button-list-black">Cancel</a>
    </div>
</div>

@section('js')
<script type="text/javascript">
    // var datajson = {{ $cities }};
    $("#prov").on('change', function () {
        // console.log("changed");

        var prov_id=$(this).val();
        // var div=$(this).parent();
        // console.log(prov_id);
        var cityopt="";

        $.ajax({
            type:'get',
            url:'{!! URL::to('findCity') !!}',
            data:{'id':prov_id},
            success:function(data) {
                // console.log('success');
                // console.log(data);
                cityopt += '<option value="" selected disabled>Select City</option>';

                for (var i=0; i<data.length; i++) {
                    cityopt += '<option value="'+data[i].city_id+'">'+data[i].type+' '+data[i].city_name+'</option>';
                }
                $('#city').html(cityopt);
            }
        })
    });

    $("#city").on('change', function () {
        // console.log("changed");

        var city_id=$(this).val();
        // var div=$(this).parent();
        // console.log(prov_id);
        var shipopt="";

        $.ajax({
            type:'get',
            url:'{!! URL::to('checkCost') !!}',
            data:{'id':city_id},
            success:function(data) {
                console.log('success');
                console.log(data);
                shipopt += '<option value="" selected disabled>Select Shipping</option>';

                for (var i=0; i<data.length; i++) {
                    shipopt += '<option value="'+data[i].cost[0].value+'">JNE '+data[i].service+' ('+data[i].cost[0].etd+' Days) : Rp '+data[i].cost[0].value+'</option>';
                }
                $('#ship').html(shipopt);
            }
        })
    });

    $("#ship").on('change', function () {
        var shippingCost=$(this).val();

        var shipcost = "Shipping Cost : Rp."+shippingCost;

        $('#shipcost').text(shipcost);
    });
    
    $("#ship").on('change', function () {
        var shippingCost = parseInt($(this).val());
        var total = parseInt($('#totalprice').text().split("Rp.").pop());

        console.log(total);
        var shipcost = shippingCost+total;

        $('#totalprice').text("Total Price : Rp."+shipcost);
    });
    
</script>
@endsection
@endsection
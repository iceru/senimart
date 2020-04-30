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
        <h1 class="os">Shipping Address</h1>
        <form id="addressForm">
            <div class="form-group">
                <label for="">Select From Address List</label>
                <select name="address_select" id="address_select" class="form-control" required>
                    <option value="" selected disabled>Select Address</option>
                    @forelse ($address as $ad)
                    <option value="{{$ad->id}}">{{$ad->receiver_name.' ('.$ad->phone_no.') - '.$ad->address.', '.$ad->city.', '.$ad->province.' '.$ad->zipcode}}</option>
                    @empty
                    <option value="" selected disabled>Address Unavailable, Please Add New</option>
                    @endforelse
                </select>
            </div>
            <button class="button-black" id="submit">Choose Selected Address</button>
            <p>Or</p>
            <a class="button-black" href="#" id="newAddress">Add New Address</a>
            <hr>
        </form>
        <div id="new" hidden>
            <form action="{{ route('address.checkoutadd') }}" method="POST">
                @method('post')
                @csrf
                <input type="hidden" name="id_sales" value="{{$sales->id}}">
                <div class="form-group">
                    <label for="">Full Name</label>
                    <input type="text" class="form-control" name="receiver_name" id="receiver_name" aria-describedby="helpId" value="{{$user->name}}" required>
                </div>
                <div class="form-group">
                    <label for="">Mobile Phone</label>
                    <input type="text" class="form-control" name="phone_no" id="phone_no" aria-describedby="helpId" placeholder="Input Phone Number" required>
                </div>
                <div class="form-group">
                    <label for="">Address</label>
                    <input type="text" class="form-control" name="address" id="address" aria-describedby="helpId" placeholder="Input Address" required>
                </div>
                <div class="form-group">
                    <label for="">Province</label>
                    <select name="province_id" id="prov" class="form-control" required>
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
                        <select name="city_id" id="city" class="form-control" required>
                            <option value="" selected disabled>Select Province First</option>
                        </select>
                        {{-- <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder=""> --}}
                    </div>
                    <div class="col">
                        <label for="">Zip</label>
                        <input type="text" class="form-control" name="zipcode" id="zipcode" aria-describedby="helpId" placeholder="Input Zip / Postal Code" required>
                    </div>
                </div>
                <hr>
                <button class="button-black" type="submit">Add Shipping Address</button>
            </form>
            {{-- old --}}
        </div>
        <div id="addressView" hidden>
            <h5>Full Name</h5><p id="vFName"></p>
            <h5>Mobile Phone</h5><p id="vPhone"></p>
            <h5>Address</h5><p id="vAddr"></p>
            <h5>Province</h5><p id="vProv"></p>
            <h5>City</h5><p id="vCity"></p>
            <h5>Zip</h5><p id="vZip"></p>
            <hr>
        </div>
        {{-- <hr>
        <div class="form-group">
            <label for="">Shipping</label>
            <select id="ship" class="form-control">
                <option value="" selected disabled>Select Province & City First</option>
            </select>
        </div> --}}
        <form id="shipMethod" hidden>
            <div class="form-group">
                <label for="">Shipping</label>
                <select id="ship" class="form-control"></select>
            </div>
            <button class="button-black" id="submit">Proceed to Payment</button>
            <a href="#" id="changeAddress" class="button-list-black">Change Address</a>
        </form>
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
                <p>{{$item->weight}}g</p>
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
            <p id="subtotal">Item(s) Subtotal : Rp.{{$sales->totalPrice}}</p>
            <p id="shipcost">Shipping Cost : Rp.0</p>
            <h2 id="totalprice">Total Price : Rp.{{$sales->totalPrice}}</h2>
        </div>
        {{-- <a class="button-black" href="">Proceed to Payment</a>
        <a href="/checkout/remove/{{$sales->id}}" class="button-list-black">Cancel</a> --}}
    </div>
</div>

@section('js')
<script type="text/javascript">

    $(document).ready(function() {
        var origVal = $('#addressForm').html();

        $('#newAddress').on('click', function (event) {
            event.preventDefault();
            $('#new').removeAttr('hidden');
        });

        $("#prov").on('change', function () {
            // console.log("changed");

            console.log("PROVINCE");
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

        //submit Address and then show Shipping Method options
        $('#addressForm').on('submit', function(event) {
            event.preventDefault();

            address_select = $('#address_select').val();

            // receiver_name = $('#receiver_name').val();
            // phone_no = $('#phone_no').val();
            // address = $('#address').val();
            // province_id = $('#prov').val();
            // city_id = $('#city').val();
            // zipcode = $('#zipcode').val();

            var shipadr = "";
            console.log('enter');
            $.ajax({
                url:'{!! URL::to('addShippingAddress') !!}',
                type: "post",
                data: {
                    "_token": "{{csrf_token()}}",
                    address_select:address_select,
                    // receiver_name:receiver_name,
                    // phone_no:phone_no,
                    // address:address,
                    // province_id:province_id,
                    // city_id:city_id,
                    // zipcode:zipcode,
                    'sid':'{{$sales->id}}' 
                },
                success:function(response) {
                    console.log(response);

                    // shipadr += '<h5>Full Name</h5><p>'+response.receiver_name+'</p>';
                    // shipadr += '<h5>Mobile Phone</h5><p>'+response.phone_no+'</p>';
                    // shipadr += '<h5>Address</h5><p>'+response.address+'</p>';
                    // shipadr += '<h5>Province</h5><p>'+response.province+'</p>';
                    // shipadr += '<h5>City</h5><p>'+response.city+'</p>';
                    // shipadr += '<h5>Zip</h5><p>'+response.zipcode+'</p>';
                    // shipadr += '<hr>';

                    $('#addressForm').attr('hidden', true);
                    $('#addressView').removeAttr('hidden');
                    $('#vFName').html(response.receiver_name);
                    $('#vPhone').html(response.phone_no);
                    $('#vAddr').html(response.address);
                    $('#vProv').html(response.province);
                    $('#vCity').html(response.city);
                    $('#vZip').html(response.zipcode);

                    // $('#addressForm').html(shipadr);

                    var shipopt="";
                    $.ajax({
                        type:'get',
                        url:'{!! URL::to('checkCost') !!}',
                        data:{
                            'id':response.city_id,
                            'weight':'{{$sales->totalweight}}'
                        },
                        success:function(data) {
                            console.log('success');
                            // console.log(data);
                            $('#shipMethod').removeAttr('hidden');
                            shipopt += '<option value="" selected disabled>Select Shipping Method</option>';
                            // shipadr += '<div class="form-group"><label for="">Shipping</label><select id="ship" class="form-control"><option value="" selected disabled>Select Shipping Method</option>'

                            for (var i=0; i<data.length; i++) {
                                shipopt += '<option value="'+data[i].cost[0].value+'">JNE '+data[i].service+' ('+data[i].cost[0].etd+' Days) : Rp.'+data[i].cost[0].value+'</option>';
                            }
                            
                            shipopt += '</select></div>'
                            $('#ship').html(shipopt);
                        }
                    })
                },
            });
        });

        // $("#city").on('change', function () {
        //     // console.log("changed");

        //     var city_id=$(this).val();
        //     // var div=$(this).parent();
        //     // console.log(prov_id);
        //     var shipopt="";

        //     $.ajax({
        //         type:'get',
        //         url:'{!! URL::to('checkCost') !!}',
        //         data:{'id':city_id},
        //         success:function(data) {
        //             console.log('success');
        //             console.log(data);
        //             shipopt += '<option value="" selected disabled>Select Shipping</option>';

        //             for (var i=0; i<data.length; i++) {
        //                 shipopt += '<option value="'+data[i].cost[0].value+'">JNE '+data[i].service+' ('+data[i].cost[0].etd+' Days) : Rp '+data[i].cost[0].value+'</option>';
        //             }
        //             $('#ship').html(shipopt);
        //         }
        //     })
        // });

        $("#ship").on('change', function () {
            var shippingCost=$(this).val();

            var shipcost = "Shipping Cost : Rp."+shippingCost;

            $('#shipcost').text(shipcost);
        });
        
        $("#ship").on('change', function () {
            var shippingCost = parseInt($(this).val());
            var total = parseInt($('#subtotal').text().split("Rp.").pop());

            // console.log(total);
            var totalprice = shippingCost+total;

            $('#totalprice').text("Total Price : Rp."+totalprice);
        });

        $('#shipMethod').on('submit', function(event) {
            event.preventDefault();

            selectedCost = $('#ship').val();

            $.ajax({
                url:'{!! URL::to('addShipCost') !!}',
                type: "post",
                data: {
                    "_token": "{{csrf_token()}}",
                    cost:selectedCost,
                    'sid':'{{$sales->id}}'
                },
                
                success:function() {
                    location.href = "/payment/{{$sales->id}}";
                }
            })
        });

        $('#changeAddress').on('click', function(event) {
            event.preventDefault();
            $('#shipMethod').attr('hidden', true);
            $('#addressView').attr('hidden', true);
            $('#addressForm').attr('hidden', false);

            $('#shipcost').text("Shipping Cost : Rp.0");
            $('#totalprice').text("Total Price : Rp.{{$sales->totalPrice}}");
        });
    })
    
</script>
@endsection
@endsection
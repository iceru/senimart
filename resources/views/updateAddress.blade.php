@extends('layouts.app')

@section('title')
Senimart - User Address
@endsection

@section('content')
<section class="profile">
    <div class="alert">
        @if (session()->has('success_message'))

        <div class="alert-success">
            {{ session()->get('success_message') }}
        </div>
        @endif

        @if(count($errors) > 0)
        <div class="alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
    <div class="flex-profile">
        <h1 class="title-profile">Update Address</h1>
        <div class="sidebar" id="sidebar">
            <div class="category">
                <a href="{{ route('profile.edit') }}">
                    <h1>My Profile</h1>
                </a>
                <hr>
            </div>

            <div class="orders">
                <a href="{{ route('orders.index') }}">
                    <h1>Orders</h1>
                </a>
                <hr>
            </div>

            <div class="wishlist">
                <h1>Wishlist</h1>
                <hr>
            </div>
        </div>
        <div class="profile-content">
            
            <form action="/user/address/update/{{ $shippingAddress->id }}" method="POST">
                @method('patch')
                @csrf
                <div class="form-group">
                    <label for="">Full Name</label>
                    <input type="text" class="form-control" name="receiver_name" id="receiver_name" aria-describedby="helpId" value="{{ old('receiver_name', $shippingAddress->receiver_name) }}" required>
                </div>
                <div class="form-group">
                    <label for="">Mobile Phone</label>
                    <input type="text" class="form-control" name="phone_no" id="phone_no" aria-describedby="helpId" placeholder="Input Phone Number" value="{{ old('phone_no', $shippingAddress->phone_no) }}" required>
                </div>
                <div class="form-group">
                    <label for="">Address</label>
                    <input type="text" class="form-control" name="address" id="address" aria-describedby="helpId" placeholder="Input Address" value="{{ old('address', $shippingAddress->address) }}" required>
                </div>
                <div class="form-group">
                    <label for="">Province</label>
                    <select name="province_id" id="prov" class="form-control" required>
                        <option value="{{ old('province_id', $shippingAddress->province_id) }}" selected>Select Province</option>
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
                        <input type="text" class="form-control" name="zipcode" id="zipcode" aria-describedby="helpId" placeholder="Input Zip / Postal Code" value="{{ old('zipcode', $shippingAddress->zipcode) }}" required>
                    </div>
                </div>
                <hr>
                <button class="button-black" type="submit">Update Shipping Address</button>
            </form>
        </div>
    </div>
</section>
@endsection

@section('js')
    <script type="text/javascript">
        $("#prov").on('change', function () {
            // console.log("changed");

            // console.log("PROVINCE");
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
    </script>
@endsection

</html>
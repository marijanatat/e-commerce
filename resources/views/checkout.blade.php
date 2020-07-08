@extends('layout')

@section('title', 'Checkout')

@section('extra-css')
 <style>
     .mt-32{
      margin-top:32px;
  }
 </style>
@endsection

@section('content')

    <div class="container">

        <h1 class="checkout-heading stylish-heading">Checkout</h1>
        <div class="checkout-section">
            <div>
                <form action="{{ route('checkout.store') }}" method="POST" id="payment-form">
                    {{ csrf_field() }}
                    <h2>Billing Details</h2>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        @if (auth()->user())
                            <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}" readonly>
                        @else
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{old('address')}}"required>
                    </div>

                    <div class="half-form">
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" name="city" value="{{old('city')}}" required>
                        </div>
                        <div class="form-group">
                            <label for="province">Province</label>
                            <input type="text" class="form-control" id="province" name="province" value="{{old('province')}}" required>
                        </div>
                    </div> <!-- end half-form -->

                    <div class="half-form">
                        <div class="form-group">
                            <label for="postalcode">Postal Code</label>
                            <input type="text" class="form-control" id="postalcode" name="postalcode" value="{{old('postalcode')}}" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{old('phone')}}" required>
                        </div>
                    </div> <!-- end half-form -->

                    <div class="spacer"></div>

                    <h2>Payment Details</h2>

                    <div class="form-group">
                        <label for="name_on_card">Name on Card</label>
                        <input type="text" class="form-control" id="name_on_card" name="name_on_card" value="">
                    </div>

                    <div class="form-group">
                        <label for="card-element">
                          Credit or debit card
                        </label>
                        <div id="card-element">
                            <input type="number" class="form-control" id="number_of_card" name="number_of_card" value="">
                        </div>

                        <!-- Used to display form errors -->
                        <div id="card-errors" role="alert"></div>
                    </div>

                    <div class="form-group">
                        <label for="name_on_card">CVC</label>
                        <input type="number" class="form-control" id="cvcnumber_of_card" name="cvc" value="">
                    </div>
                    <div class="spacer"></div>

                    <button type="submit" class="button-primary full-width">Complete Order</button>

                </form>
                
                @if ($paypalToken)
                    <div class="mt-32">or</div>
                    <div class="mt-32">
                        <h2>Pay with PayPal</h2>

                        <form method="post" id="paypal-payment-form" action="{{ route('checkout.paypal') }}">
                            @csrf
                            <section>
                                <div class="bt-drop-in-wrapper">
                                    <div id="bt-dropin"></div>
                                </div>
                            </section>

                            <input id="nonce" name="payment_method_nonce" type="hidden" />
                            <button class="button-primary" type="submit"><span>Pay with PayPal</span></button>
                        </form>
                    </div>
                @endif
            </div>

            <div class="checkout-table-container">
                <h2>Your Order</h2>

                <div class="checkout-table">
                    @foreach (Cart::content() as $item)
                    
                   
                    <div class="checkout-table-row">
                        <div class="checkout-table-row-left">
                            <img src="{{asset('storage/'.$item->model->image)}}" alt="item" class="checkout-table-img">
                            <div class="checkout-item-details">
                                <div class="checkout-table-item">{{$item->model->name}}</div>
                                <div class="checkout-table-description">{{$item->model->details}}</div>
                                <div class="checkout-table-price">{{$item->model->presentPrice()}}</div>
                            </div>
                        </div> <!-- end checkout-table -->
                       

                        <div class="checkout-table-row-right">
                        <div class="checkout-table-quantity">{{$item->qty}}</div>
                        </div>
                    </div> <!-- end checkout-table-row -->
                    @endforeach
            
                </div> <!-- end checkout-table -->

                <div class="checkout-totals">
                    <div class="checkout-totals-left">
                        Subtotal <br>
                        {{-- Discount (10OFF - 10%) <br> --}}
                        Tax <br>
                        <span class="checkout-totals-total">Total</span>

                    </div>

                    <div class="checkout-totals-right">
                      {{Cart::subtotal()}} <br>
                        {{-- -$750.00 <br> --}}
                    {{Cart::tax()}} <br>
                        <span class="checkout-totals-total">{{Cart::total()}}</span>

                    </div>
                </div> <!-- end checkout-totals -->

            </div>

        </div> <!-- end checkout-section -->
    </div>

@endsection
@section('extra-js')
    <script src="https://js.braintreegateway.com/web/dropin/1.13.0/js/dropin.min.js"></script>

    <script>
      
       var form = document.querySelector('#paypal-payment-form');
            var client_token = "{{ $paypalToken }}";
            braintree.dropin.create({
              authorization: client_token,
              selector: '#bt-dropin',
              paypal: {
                flow: 'vault'
              }
            }, function (createErr, instance) {
              if (createErr) {
                console.log('Create Error', createErr);
                return;
              }
              // remove credit card option
              var elem = document.querySelector('.braintree-option__card');
              elem.parentNode.removeChild(elem);
              form.addEventListener('submit', function (event) {
                event.preventDefault();
                instance.requestPaymentMethod(function (err, payload) {
                  if (err) {
                    console.log('Request Payment Method Error', err);
                    return;
                  }
                  // Add the nonce to the form and submit
                  document.querySelector('#nonce').value = payload.nonce;
                  form.submit();
                });
              });
            });
        })();
    </script>
@endsection

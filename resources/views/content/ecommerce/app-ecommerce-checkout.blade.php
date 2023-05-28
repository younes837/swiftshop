@extends('layouts/contentLayoutMaster')

@section('title', 'Checkout')

@section('vendor-style')
  <!-- Vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/wizard/bs-stepper.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/spinner/jquery.bootstrap-touchspin.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection

@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-ecommerce.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-pickadate.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-wizard.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-number-input.css')) }}">
@endsection

@section('content')

  <!-- Wizard starts -->
  
  <!-- Wizard ends -->

  <div >
    <!-- Checkout Place order starts -->
    <div  class="content" role="tabpanel" >
      <div id="place-order" class="list-view product-checkout">
        <!-- Checkout Place Order Left starts -->
        @include('/content/ecommerce/content-checkout')
       
        <!-- Checkout Place Order Left ends -->

        <!-- Checkout Place Order Right starts -->
       
      </div>

        
   
      <!-- Checkout Place order Ends -->
    </div>
    <!-- Checkout Customer Address Starts -->
    {{-- <div id="step-address" class="content" role="tabpanel" aria-labelledby="step-address-trigger">
      <form id="checkout-address" class="list-view product-checkout">
        <!-- Checkout Customer Address Left starts -->
        <div class="card">
          <div class="card-header flex-column align-items-start">
            <h4 class="card-title">Add New Address</h4>
            <p class="card-text text-muted mt-25">Be sure to check "Deliver to this address" when you have finished</p>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6 col-sm-12">
                <div class="mb-2">
                  <label class="form-label" cfor="checkout-name">Full Name:</label>
                  <input type="text" id="checkout-name" class="form-control" name="fname" placeholder="John Doe" />
                </div>
              </div>
              <div class="col-md-6 col-sm-12">
                <div class="mb-2">
                  <label class="form-label" cfor="checkout-number">Mobile Number:</label>
                  <input
                    type="number"
                    id="checkout-number"
                    class="form-control"
                    name="mnumber"
                    placeholder="0123456789"
                  />
                </div>
              </div>
              <div class="col-md-6 col-sm-12">
                <div class="mb-2">
                  <label class="form-label" cfor="checkout-apt-number">Flat, House No:</label>
                  <input
                    type="number"
                    id="checkout-apt-number"
                    class="form-control"
                    name="apt-number"
                    placeholder="9447 Glen Eagles Drive"
                  />
                </div>
              </div>
              <div class="col-md-6 col-sm-12">
                <div class="mb-2">
                  <label class="form-label" cfor="checkout-landmark">Landmark e.g. near apollo hospital:</label>
                  <input
                    type="text"
                    id="checkout-landmark"
                    class="form-control"
                    name="landmark"
                    placeholder="Near Apollo Hospital"
                  />
                </div>
              </div>
              <div class="col-md-6 col-sm-12">
                <div class="mb-2">
                  <label class="form-label" cfor="checkout-city">Town/City:</label>
                  <input type="text" id="checkout-city" class="form-control" name="city" placeholder="Tokyo" />
                </div>
              </div>
              <div class="col-md-6 col-sm-12">
                <div class="mb-2">
                  <label class="form-label" cfor="checkout-pincode">Pincode:</label>
                  <input type="number" id="checkout-pincode" class="form-control" name="pincode" placeholder="201301" />
                </div>
              </div>
              <div class="col-md-6 col-sm-12">
                <div class="mb-2">
                  <label class="form-label" cfor="checkout-state">State:</label>
                  <input type="text" id="checkout-state" class="form-control" name="state" placeholder="California" />
                </div>
              </div>
              <div class="col-md-6 col-sm-12">
                <div class="mb-2">
                  <label class="form-label" cfor="add-type">Address Type:</label>
                  <select class="form-select" id="add-type">
                    <option>Home</option>
                    <option>Work</option>
                  </select>
                </div>
              </div>
              <div class="col-12">
                <button type="button" class="btn btn-primary btn-next delivery-address">Save And Deliver Here</button>
              </div>
            </div>
          </div>
        </div>
        <!-- Checkout Customer Address Left ends -->

        <!-- Checkout Customer Address Right starts -->
        <div class="customer-card">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">John Doe</h4>
            </div>
            <div class="card-body actions">
              <p class="card-text mb-0">9447 Glen Eagles Drive</p>
              <p class="card-text">Lewis Center, OH 43035</p>
              <p class="card-text">UTC-5: Eastern Standard Time (EST)</p>
              <p class="card-text">202-555-0140</p>
              <button type="button" class="btn btn-primary w-100 btn-next delivery-address mt-2">
                Deliver To This Address
              </button>
            </div>
          </div>
        </div>
        <!-- Checkout Customer Address Right ends -->
      </form>
    </div>
    <!-- Checkout Customer Address Ends -->
    <!-- Checkout Payment Starts -->
    <div id="step-payment" class="content" role="tabpanel" aria-labelledby="step-payment-trigger">
      <form id="checkout-payment" class="list-view product-checkout" onsubmit="return false;">
        <div class="payment-type">
          <div class="card">
            <div class="card-header flex-column align-items-start">
              <h4 class="card-title">Payment options</h4>
              <p class="card-text text-muted mt-25">Be sure to click on correct payment option</p>
            </div>
            <div class="card-body">
              <h6 class="card-holder-name my-75">John Doe</h6>
              <div class="form-check">
                <input type="radio" id="customColorRadio1" name="paymentOptions" class="form-check-input" checked />
                <label class="form-check-label" for="customColorRadio1">
                  US Unlocked Debit Card 12XX XXXX XXXX 0000
                </label>
              </div>
              <div class="customer-cvv mt-1 row row-cols-lg-auto">
                <div class="col-3 d-flex align-items-center">
                  <label class="mb-50 form-label" for="card-holder-cvv">Enter CVV:</label>
                </div>
                <div class="col-4 p-0">
                  <input type="password" class="form-control mb-50 input-cvv" name="input-cvv" id="card-holder-cvv" />
                </div>
                <div class="col-3">
                  <button type="button" class="btn btn-primary btn-cvv mb-50">Continue</button>
                </div>
              </div>
              <hr class="my-2"/>
              <ul class="other-payment-options list-unstyled">
                <li class="py-50">
                  <div class="form-check">
                    <input type="radio" id="customColorRadio2" name="paymentOptions" class="form-check-input" />
                    <label class="form-check-label" for="customColorRadio2"> Credit / Debit / ATM Card </label>
                  </div>
                </li>
                <li class="py-50">
                  <div class="form-check">
                    <input type="radio" id="customColorRadio3" name="paymentOptions" class="form-check-input" />
                    <label class="form-check-label" for="customColorRadio3"> Net Banking </label>
                  </div>
                </li>
                <li class="py-50">
                  <div class="form-check">
                    <input type="radio" id="customColorRadio4" name="paymentOptions" class="form-check-input" />
                    <label class="form-check-label" for="customColorRadio4"> EMI (Easy Installment) </label>
                  </div>
                </li>
                <li class="py-50">
                  <div class="form-check">
                    <input type="radio" id="customColorRadio5" name="paymentOptions" class="form-check-input" />
                    <label class="form-check-label" for="customColorRadio5"> Cash On Delivery </label>
                  </div>
                </li>
              </ul>
              <hr class="my-2"/>
              <div class="gift-card mb-25">
                <p class="card-text">
                  <i data-feather="plus-circle" class="me-50 font-medium-5"></i>
                  <span class="align-middle">Add Gift Card</span>
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="amount-payable checkout-options">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Price Details</h4>
            </div>
            <div class="card-body">
              <ul class="list-unstyled price-details">
                <li class="price-detail">
                  <div class="details-title">Price of 3 items</div>
                  <div class="detail-amt">
                    <strong>$699.30</strong>
                  </div>
                </li>
                <li class="price-detail">
                  <div class="details-title">Delivery Charges</div>
                  <div class="detail-amt discount-amt text-success">Free</div>
                </li>
              </ul>
              <hr />
              <ul class="list-unstyled price-details">
                <li class="price-detail">
                  <div class="details-title">Amount Payable</div>
                  <div class="detail-amt fw-bolder">$699.30</div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </form>
    </div> --}}
    <!-- Checkout Payment Ends -->
    <!-- </div> -->
  </div>


@endsection

@section('vendor-script')
  <!-- Vendor js files -->
  <script src="{{ asset(mix('vendors/js/forms/wizard/bs-stepper.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/spinner/jquery.bootstrap-touchspin.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
@endsection

@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset(mix('js/scripts/pages/app-ecommerce-checkout.js')) }}"></script>
@endsection

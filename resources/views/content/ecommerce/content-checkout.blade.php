<div class="checkout-items">

@php $total = 0 @endphp
@if(session('cart'))
    @foreach(session('cart') as $id => $details)
        @php $total += $details['price'] * $details['quantity'] @endphp
  <div class="card ecommerce-card">
    <div class="item-img">
      <a href="{{url('app/ecommerce/details/'.$id)}}">
        <img src="{{asset($details['photo'])}}" alt="img-placeholder" />
      </a>
    </div>
    <div class="card-body">
      <div class="item-name">
        <h6 class="mb-0"><a href="{{url('app/ecommerce/details/'.$id)}}" class="text-body">{{$details['product_name']}}</a></h6>
        <span class="item-company">By <a href="#" class="company-name">{{$details['brand']}}</a></span>
        <div class="item-rating">
          <ul class="unstyled-list list-inline">
            
              @for ($i = 0; $i < $details['rating']; $i++)
     
                <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
              @endfor
              @for ($i = 0; $i < 5 - $details['rating']; $i++)
     
                <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
              @endfor
  
              
            
          </ul>
        </div>
      </div>
      <span class="text-success mb-1">In Stock</span>
      <div class="item-quantity">
        <span class="quantity-title ">Qty:</span>
        <div class="quantity-counter-wrapper">
          <div class="input-group" data-id="{{$id}}">
           
            <input type="text" class="form-control form-control-sm mx-3  cart_update " style="width: 40px" value="{{$details['quantity']}}" />
          
          </div>
        </div>
      </div>
      <span class="delivery-date text-muted">Delivery by, Wed Apr 25</span>
      <span class="text-success">17% off 4 offers Available</span>
    </div>
    <div class="item-options text-center">
      <div class="item-wrapper">
        <div class="item-cost">
          <h4 class="item-price">${{$details['price']*$details['quantity']}}</h4>
          <p class="card-text shipping">
            <span class="badge rounded-pill badge-light-success">Free Shipping</span>
          </p>
        </div>
      </div>
      <button type="button" class="btn btn-light mt-1 cart_remove">
        <i data-feather="x" class="align-middle me-25"></i>
        <input type="hidden" id="id" value="{{$id}}">
        <span>Remove</span>
      </button>
      
    </div>
  </div>
  @endforeach
  @endif
</div>
<div class="checkout-options">
    <div class="card">
      <div class="card-body">
        <label class="section-label form-label mb-1">Options</label>
        <div class="coupons input-group input-group-merge">
          <input
            type="text"
            class="form-control"
            placeholder="Coupons"
            aria-label="Coupons"
            aria-describedby="input-coupons"
          />
          <span class="input-group-text text-primary ps-1" id="input-coupons">Apply</span>
        </div>
        <hr />
        <div class="price-details">
          <h6 class="price-title">Price Details</h6>
          <ul class="list-unstyled">
            <li class="price-detail">
              <div class="detail-title">Total MRP</div>
              <div id="total-checkout" class="detail-amt">${{$total}}</div>
            </li>
            <li class="price-detail">
              <div class="detail-title">Bag Discount</div>
              <div class="detail-amt discount-amt text-success">-25$</div>
            </li>
            <li class="price-detail">
              <div class="detail-title">Estimated Tax</div>
              <div class="detail-amt">$1.3</div>
            </li>
            <li class="price-detail">
              <div class="detail-title">EMI Eligibility</div>
              <a href="#" class="detail-amt text-primary">Details</a>
            </li>
            <li class="price-detail">
              <div class="detail-title">Delivery Charges</div>
              <div class="detail-amt discount-amt text-success">Free</div>
            </li>
          </ul>
          <hr />
          <ul class="list-unstyled">
            <li class="price-detail">
              <div class="detail-title detail-total">Total</div>
              <div class="detail-amt fw-bolder">$574</div>
            </li>
          </ul>
          <button type="button" data-bs-toggle="modal" data-bs-target="#checkout"  class="btn btn-primary w-100 btn-next place-order">Place Order</button>
        </div>
      </div>
    </div>
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
    <!-- Checkout Place Order Right ends -->
  </div>
  
<script type="text/javascript">
   
  $(".cart_update").change(function (e) {
      e.preventDefault();
 
      var ele = $(this);
  // console.log(ele.val());

      $.ajax({
          url: '{{ route('update_cart') }}',
          method: "put",
          data: {
              _token: '{{ csrf_token() }}', 
              id: ele.parents("div").attr("data-id") ,
              quantity: ele.val()
          },
          success: function (response) {
            $('.product-checkout').html(response)
            var total=$('#total-checkout').html()
            // console.log(total);
            $('#cart-total').html(total);
              feather.replace();
              
              console.log(it);
              // console.log($('#item-quantity').html());
              // console.log(response);
            
          }
      });
  });
 
  $(".cart_remove").click(function (e) {
      e.preventDefault();
 
      var ele = $(this);
 
      // if(confirm("Do you really want to remove?")) {
          $.ajax({
              url: '{{ route('remove_from_cart') }}',
              method: "DELETE",
              data: {
                  _token: '{{ csrf_token() }}', 
                  id: ele.find("#id").val()
              },
              success: function (response) {
                $('.product-checkout').html(response)
                  feather.replace();
              }
          });
      // }
  });
 
</script>
</div>
@isset($user)
    

<div class="modal fade" id="checkout" tabindex="-1" role="dialog" aria-labelledby="checkout" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user" role="document">
    <div class="modal-content">
      <div class="modal-header bg-transparent">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body pb-5 px-sm-5 pt-50">
     
        {{-- start avatar --}}
       
        {{-- end avatar --}}

        <form class="form" method="GET" action="{{url('Commande/create')}}"  enctype="multipart/form-data">
          @csrf
          @method('POST')
          <div class="row">
            <div class="col-md-6 col-12">
              <div class="form-group">
                <label for="first-name-column">Name</label>
                <input
                  type="text"
                  id="first-name-column"
                  class="form-control"
                  placeholder="Name"
                  name="name"
                  value="{{$user->name}}"
                  disabled
                />
               
              </div>
            </div>
            <div class="col-md-6 col-12">
              <div class="form-group">
                <label for="last-name-column">email</label>
                <input
                  type="text"
                  id="last-name-column"
                  class="form-control"
                  placeholder="email"
                  name="email"
                  value="{{$user->email}}"
                  disabled
                />
               
              </div>
            </div>
            <div class="col-md-6 col-12">
              <label class="form-label" for="selectDefault">Role</label>
              <select class="form-select " disabled name="role" id="selectDefault">
                <option value="{{$user->role_id}}">{{App\Models\Roles::where('id',$user->role_id)->first()->libelle}}</option>
                
              
              </select>
            </div>
          
       
            <div class="col-md-6 col-12">
              <div class="form-group">
                <label for="email-id-column">Phone</label>
                <input
                  type="number"
                  id="email-id-column"
                  class="form-control"
                  name="phone"
                  placeholder="phone"
                  disabled
                  value="{{$user->phone}}"
                />
               
              </div>
            </div>
            <div class="col-md-6 col-12">
              <div class="form-group">
                <label for="company-column">address</label>
                <input
                  type="text"
                  id="company-column"
                  class="form-control"
                  name="address"
                  placeholder="address"
                  value="{{$user->adress}}"
                />
               
              </div>
            </div>
            {{-- <div class="col-md-6 col-12">
              <label class="form-label" for="select2-basic">City</label>
              <select class="select2 form-select form-control" name="ville">
                <option value="">-- Select a City --</option>
                @foreach ($villes as $ville)
                <option value="{{$ville->id}}">{{$ville->name}}</option>
                @endforeach
              </select>
              @if ($errors->has('ville'))
              <span class="text-danger">{{ $errors->first('ville') }}</span>
              @endif
            </div> --}}
         
            <div class="col-md-6 col-12">
              <label class="form-label" for="selectDefault">City</label>
              <select class="form-select "  name="ville" id="selectDefault">
                @foreach (App\Models\Ville::all() as $ville)
                    
                <option value="{{$ville->name}}" @if ($ville->id==$user->ville_id)
                    selected
                @endif>{{$ville->name}}</option>
                @endforeach
             
                
              </select>
            </div>
          </div>        
          <div class="modal-footer">
            <button type="submit" id="button_edit" rippleEffect class="btn btn-primary mr-1">Submit</button>
            <button type="reset" rippleEffect class="btn btn-outline-secondary">Reset</button>
          </div>
        </form>
      </div>
    </div>   
  </div></div>
  @endisset
@extends('layouts/detachedLayoutMaster')

@section('title', 'Shop')

@section('vendor-style')
<!-- Vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/nouislider.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />
  
<link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">

@endsection
@section('page-style')
<style>
    .avatar-xxs{height:1.5rem;width:1.5rem}.avatar-xs{height:2rem;width:2rem}.avatar-sm{height:3rem;width:4rem}.avatar-md{height:4.5rem;width:4.5rem}.avatar-lg{height:6rem;width:6rem}.avatar-xl{height:7.5rem;width:7.5rem}.avatar-title{align-items:center;background-color:var(--tb-primary-text-emphasis);color:#fff;display:flex;font-weight:var(--tb-font-weight-medium);height:100%;justify-content:center;width:100%}.avatar-group{padding-left:12px;display:flex;flex-wrap:wrap}.avatar-group .avatar-group-item{margin-left:-12px;border:2px solid var(--tb-border-color);border-radius:50%;transition:all .2s}.avatar-group .avatar-group-item:hover{position:relative;transform:translateY(-2px);z-index:1}
</style>
<!-- Page css files -->
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-sliders.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-ecommerce.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
@endsection


@section('content')
<section class="app-user-view-account">
    <div class="row">
      <!-- User Sidebar -->
      <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
        <!-- User Card -->
        <div class="card">
          <div class="card-body">
            <div class="user-avatar-section">
              <div class="d-flex align-items-center flex-column">
                <img
                  class="img-fluid rounded mt-3 mb-2"
                  src="{{asset('images/'.$user->avatar)}}"
                  height="110"
                  width="110"
                  alt="User avatar"
                />
                <div class="user-info text-center">
                  <h4>{{$user->name}}</h4>
                  <span class="badge bg-light-secondary">{{App\Models\Roles::find($user->role_id)->libelle}}</span>
                </div>
              </div>
            </div>
            <div class="d-flex justify-content-around my-2 pt-75">
                <div class="d-flex align-items-start me-2">
                    <span class="badge bg-light-primary p-75 rounded">
                      <i data-feather="credit-card" class="font-medium-2"></i>
                    </span>
                    <div class="ms-75">
                      <h4 class="mb-0">{{count(App\Models\Commande::where('user_id',Auth::user()->id)->get())}}</h4>
                      <small>Orders</small>
                    </div>
                  </div>
                  <div class="d-flex align-items-start">
                    <span class="badge bg-light-primary p-75 rounded">
                      <i data-feather="shopping-bag" class="font-medium-2"></i>
                    </span>
                    <div class="ms-75">
                      <h4 class="mb-0">{{count(App\Models\Commande::join('produit_commande','commande.id','produit_commande.commande_id')->where('commande.user_id',Auth::user()->id)->get())}}</h4>
                      <small>Products Ordred</small>
                    </div>
                  </div>
            </div>
            <h4 class="fw-bolder border-bottom pb-50 mb-1">Details</h4>
            <div class="info-container">
              <ul class="list-unstyled">
                <li class="mb-75">
                  <span class="fw-bolder me-25">Username:</span>
                  <span>{{$user->name}}</span>
                </li>
                <li class="mb-75">
                  <span class="fw-bolder me-25">Email:</span>
                  <span>{{$user->email}}</span>
                </li>
                <li class="mb-75">
                  <span class="fw-bolder me-25">Contact:</span>
                  <span>+212 {{$user->phone}}</span>
                </li>
                <li class="mb-75">
                  <span class="fw-bolder me-25">Language:</span>
                  <span>English</span>
                </li>
                <li class="mb-75">
                  <span class="fw-bolder me-25">Country:</span>
                  <span>Morocco</span>
                </li>
                <li class="mb-75">
                  <span class="fw-bolder me-25">City:</span>
                  <span>{{App\Models\Ville::find($user->ville_id)->name}}</span>
                </li>
                <li class="mb-75">
                  <span class="fw-bolder me-25">Address:</span>
                  <span>{{$user->adress}}</span>
                </li>
              </ul>
              <div class="d-flex justify-content-center pt-2">
                <a href="javascript:;" class="btn btn-primary me-1" data-bs-target="#editUser" data-bs-toggle="modal">
                  Edit
                </a>
              </div>
            </div>
          </div>
        </div>
        <!-- /Edit User -->
   
<!-- Edit User Modal -->
<div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
      <div class="modal-content">
        <div class="modal-header bg-transparent">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
       
        <div class="modal-body pb-5 px-sm-5 pt-50">
            {{-- <div class="user-avatar-section">
                <div class="d-flex align-items-center flex-column">
                  <img
                    class="img-fluid rounded mt-3 mb-2"
                    src="{{asset('images/'.$user->avatar)}}"
                    height="110"
                    width="110"
                    alt="User avatar"
                  />
         
                </div>
                
              </div> --}}
              <div class="text-center mb-2">
                <h1 class="mb-1">Edit Your Information</h1>
                <p>Updating your details will receive a privacy audit.</p>
              </div>
          <form id="editUserForm" method="POST" class="row gy-1 pt-75" action="{{route('Profile.update',$user->id)}}" enctype="multipart/form-data"   >
            @csrf
            @method('PUT')
            <div class="col-12 col-md-6">
              <label class="form-label" for="modalEditUserFirstName">Full Name</label>
              <input
                type="text"
                id="modalEditUserFirstName"
                name="name"
                class="form-control"
                placeholder="Full Name"
                value="{{$user->name}}"
                data-msg="Please enter your first name"
              />
            </div>
            <input type="hidden" value='profil' name='profil'>
            <div class="col-12 col-md-6">
              <label class="form-label" for="modalEditUserLastName">Email</label>
              <input
                type="text"
                id="modalEditUserLastName"
                name="email"
                class="form-control"
                placeholder="Email"
                value="{{$user->email}}"
                data-msg="Please enter your last name"
              />
            </div>
            <div class="col-12">
              <label class="form-label" for="modalEditUserName">Address</label>
              <input
                type="text"
                id="modalEditUserName"
                name="address"
                class="form-control"
                value="{{$user->adress}}"
                placeholder="Address"
              />
            </div>

            <div class="col-12 col-md-6">
                <label class="form-label" for="modalEditUserPhone">Photo</label>
              
                <input type="file" id="city-column" class="form-control" p name="avatar" />

              </div>
              <div class="col-12 col-md-6">
                <label class="form-label" for="modalEditUserPhone">Country</label>
                <input
                  type="text"
                  id="modalEditUserPhone"
                  name="modalEditUserPhone"
                  class="form-control phone-number-mask"
                  placeholder="+1 (609) 933-44-22"
                  value="Morocco"
                  readonly
                />
              </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="modalEditUserStatus">City</label>
              <select
              id="select2-basic"
                name="ville"
                class="select2 form-select form-control"
                aria-label="Default select example"
              >
              @foreach (App\Models\Ville::all() as $ville)
                  
              <option value="{{$ville->id}}" @if($ville->id==$user->ville_id) selected @endif>{{$ville->name}}</option>
              @endforeach
            
              </select>
            </div>
         
            <div class="col-12 col-md-6">
              <label class="form-label" for="modalEditUserPhone">Contact</label>
              <input
                type="text"
                id="modalEditUserPhone"
                name="phone"
                class="form-control phone-number-mask"
                placeholder="+1 (609) 933-44-22"
                value="{{$user->phone}}"
              />
            </div>
           
            <div class="col-12 text-center mt-2 pt-50">
              <button type="submit" class="btn btn-primary me-1">Submit</button>
              <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
                Discard
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!--/ Edit User Modal -->
  

        <!-- /Edit User -->
      </div>
      <!--/ User Sidebar -->
  
      <!-- User Content -->
      <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
        <!-- User Pills -->
        <ul class="nav nav-pills mb-2">
          <li class="nav-item">
            <a class="nav-link active" href="/profile">
              <i data-feather="user" class="font-medium-3 me-50"></i>
              <span class="fw-bold">Account</span></a
            >
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/profile-security">
              <i data-feather="lock" class="font-medium-3 me-50"></i>
              <span class="fw-bold">Security</span>
            </a>
          </li>
         
        </ul>
        <!--/ User Pills -->
  
        <!-- Project table -->
        <div class="card">
            <h4 class="card-header">Products Ordred</h4>
           
            <div class="table-responsive ">
                <table class="table table-hover">
                  <thead>
                    <tr>
                        
                      <th >Product</th>
                      <th>Price</th>
                      <th>Quantity</th>
                      <th>Amount</th>
                     
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($commandes as $item)
                          <tr>
                              
                            
                            <td>
                                <div class="product-item d-flex align-items-center gap-2">
                                    <div class="avatar-sm flex-shrink-0">
                                        <div class="avatar-title bg-light rounded">
                                            <img src="{{asset($item->photo)}}" alt="" class="avatar-sm">
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="fs-md"><a href="{{url('app/ecommerce/details/'.$item->id)}}" class="text-reset">{{$item->libelle}}</a></h6>
                                        <p class="text-muted mb-0"><a href="#!" class="text-reset">{{App\Models\Brand::where('id',$item->brand_id)->first()->name}}</a></p>
                                    </div>
                                </div>
                            </td>
                            <td>${{$item->price}}</td>
                            <td>{{$item->quantite}}</td>
                            <td>${{$item->price*$item->quantite}}</td>
                         
      
                         </tr>
                      @endforeach
                   
                  </tbody>
                </table>
                
              </div>
              </div>
        <!-- /Project table -->
  
        <!-- Invoice table -->
        <div class="card">
            <h4 class="card-header">Favorite Products</h4>
          <table class="invoice-table table text-nowrap">
            <thead>
              <tr>
                
                <th>Product</th>
                <th>Price</th>
                <th>Categorie</th>
               <th></th>
              </tr>
            </thead>
            <tbody>
                @foreach ($produits as $item)
                <tr>
                <td>
                    <div class="product-item d-flex align-items-center gap-2">
                        <div class="avatar-sm flex-shrink-0">
                            <div class="avatar-title bg-light rounded">
                                <img src="{{asset($item->photo)}}" alt="" class="avatar-sm">
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="fs-md"><a href="{{url('app/ecommerce/details/'.$item->id)}}" class="text-reset">{{$item->libelle}}</a></h6>
                            <p class="text-muted mb-0"><a href="#!" class="text-reset">{{App\Models\Brand::where('id',$item->brand_id)->first()->name}}</a></p>
                        </div>
                    </div>
                </td>
                <td>{{$item->price}}</td>
                <td>{{App\Models\Categorie::find($item->categorie_id)->name}}</td>
                <td><a href="{{route('Commande.show',$item->id)}}"><i  data-feather='eye'></i></a></td>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
        <!-- /Invoice table -->
      </div>
      <!--/ User Content -->
    </div>
  </section>

@endsection


@section('vendor-script')
<!-- Vendor js files -->
<script src="{{ asset(mix('vendors/js/extensions/wNumb.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/extensions/nouislider.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
@endsection
@section('page-script')
<!-- Page js files -->
<script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
<script src="{{ asset(mix('js/scripts/pages/app-ecommerce.js')) }}"></script>
@endsection

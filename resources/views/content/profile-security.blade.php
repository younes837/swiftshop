@extends('layouts/detachedLayoutMaster')

@section('title', 'Shop')
@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/animate/animate.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/sweetalert2.min.css')) }}">
@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-sweet-alerts.css')) }}">
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
          <form id="editUserForm" method="Post" class="row gy-1 pt-75" action="{{route('Users.update',$user->id)}}" enctype="multipart/form-data"   >
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
            <a class="nav-link " href="/profile">
              <i data-feather="user" class="font-medium-3 me-50"></i>
              <span class="fw-bold">Account</span></a
            >
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="/profile-security">
              <i data-feather="lock" class="font-medium-3 me-50"></i>
              <span class="fw-bold">Security</span>
            </a>
          </li>
         
        </ul>
        <!--/ User Pills -->
  
        <!-- Project table -->
       
        <!-- /Project table -->
  
        <!-- Invoice table -->
       
        <!-- /Invoice table -->
        <div class="card">
            <h4 class="card-header">Change Password</h4>
            <div class="card-body">
              <form id="formChangePassword" method="POST" action="{{url('/password')}}" >
                @csrf
                @method('PUT')
                <div class="alert alert-warning mb-2" role="alert">
                  <h6 class="alert-heading">Ensure that these requirements are met</h6>
                  <div class="alert-body fw-normal">Minimum 8 characters long.</div>
                </div>
    
                <div class="row">
                  <div class="mb-2 col-md-6 form-password-toggle">
                    <label class="form-label" for="newPassword">New Password</label>
                    <div class="input-group input-group-merge form-password-toggle">
                      <input
                        class="form-control"
                        type="password"
                        id="newPassword"
                        name="password"
                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      />
                      <span class="input-group-text cursor-pointer">
                        <i data-feather="eye"></i>
                      </span>
                    </div>
                  </div>
    
                  <div class="mb-2 col-md-6 form-password-toggle">
                    <label class="form-label" for="confirmPassword">Confirm New Password</label>
                    <div class="input-group input-group-merge">
                      <input
                        class="form-control"
                        type="password"
                        name="confirmPassword"
                        id="confirmPassword"
                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      />
                      <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                    </div>
                  </div>
                  <div>
                    <button type="submit" class="btn btn-primary me-2">Change Password</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
      </div>
      <!--/ User Content -->
      
    </div>
  </section>

@endsection


@section('vendor-script')
  {{-- Vendor js files --}}
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/cleave/cleave.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/cleave/addons/cleave-phone.us.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/polyfill.min.js')) }}"></script>
@endsection

@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/pages/modal-two-factor-auth.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/pages/modal-edit-user.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/pages/app-user-view-security.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/pages/app-user-view.js')) }}"></script>
@endsection


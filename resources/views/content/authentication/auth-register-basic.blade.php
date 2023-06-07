@extends('layouts/fullLayoutMaster')

@section('title', 'Register Page')
@section('vendor-style')
<link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection
@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/authentication.css')) }}">
@endsection

@section('content')
<div class="auth-wrapper auth-basic px-2">
  <div class="w-50 my-2">
    <!-- Register basic -->
    <div class="card mb-0">
      <div class="card-body">
        <a href="/home" class="brand-logo">
          <img  src="{{asset('images/logo/swift-shop.png' )}}" width="60" height="65" alt="">

          <h2 style="margin-top: 23px" class="brand-text text-primary ms-1">Swift Shop</h2>
        </a>

      

        <form class="form mt-2" action="/postsignup" method="POST" id="#formChangePassword" enctype="multipart/form-data">
          @csrf
          <div class="row">
          <div class="mb-1 col-md-6 col-12">
            <label for="register-username" class="form-label">Name</label>
            <input
              type="text"
              class="form-control"
              id="register-username"
              name="name"
              placeholder="johndoe"
              aria-describedby="register-username"
              tabindex="1"
              autofocus
            />
            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
          </div>
          <div class="mb-1 col-md-6 col-12">
            <label for="register-email" class="form-label">Email</label>
            <input
              type="text"
              class="form-control"
              id="register-email"
              name="email"
              placeholder="john@example.com"
              aria-describedby="register-email"
              tabindex="2"
            />
            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
          </div>
         
       

          <div class="mb-1 col-md-6 col-12">
            <label for="register-password" class="form-label">Password</label>

            <div class="input-group input-group-merge form-password-toggle">
              <input
                type="password"
                class="form-control form-control-merge"
                id="newPassword"
                name="password"

                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                aria-describedby="register-password"
                tabindex="3"
              />
              <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
            </div>
            @if ($errors->has('password'))
                 <span class="text-danger">{{ $errors->first('password') }}</span>
               @endif
          </div>
          <div class="mb-1 col-md-6 col-12">
            <label for="register-password" class="form-label"> Confirm Password</label>

            <div class="input-group input-group-merge form-password-toggle">
              <input
                type="password"
                class="form-control form-control-merge"
               
                name="confirm_password"
                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                aria-describedby="register-password"
                tabindex="3"
              />
              <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
            </div>
            @if ($errors->has('confirm_password'))
               <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
            @endif
          </div>
          <div class="mb-1 col-md-12 col-12">
            <label for="register-email" class="form-label">Adresse</label>
            <input
              type="text"
              class="form-control"
              id="register-email"
              name="adress"
              placeholder="Adresse"
              
              tabindex="2"
            />
            @if ($errors->has('adress'))
                                <span class="text-danger">{{ $errors->first('adress') }}</span>
                                @endif
          </div>
          <div class="mb-1 col-md-6 col-12">
            <label class="form-label" for="select2-basic">City</label>
            <select class="select2 form-select form-control" name="ville" id="select2-basic">
              @foreach ($villes as $ville)
              <option value="{{$ville->id}}">{{$ville->name}}</option>
                  
              @endforeach
            </select>
          </div>
          
          <div class="mb-1 col-md-6 col-12">
            <label for="register-email" class="form-label">Phone</label>
            <input
              type="number"
              class="form-control"
              id="register-email"
              name="phone"
              placeholder="Phone"
              
              tabindex="2"
            />
            @if ($errors->has('phone'))
                                <span class="text-danger">{{ $errors->first('phone') }}</span>
                                @endif
          </div>
          {{-- <div class="mb-1">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="register-privacy-policy" tabindex="4" />
              <label class="form-check-label" for="register-privacy-policy">
                I agree to <a href="#">privacy policy & terms</a>
              </label>
            </div>
          </div> --}}
          <div class="mb-1 col-md-12 col-12">
            <label for="formFile" class="form-label">Avatar</label>
            <input class="form-control" type="file" id="formFile" name="avatar" />
            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
          </div>

          <div class="col-12 d-flex justify-content-center mt-1">

            <button class="btn btn-primary " tabindex="5">Sign up</button>
          </div>
        </div>
        </form>

        <p class="text-center mt-2">
          <span>Already have an account?</span>
          <a href="{{url('login')}}">
            <span>Sign in instead</span>
          </a>
        </p>

        
      </div>
    </div>
    <!-- /Register basic -->
  </div>
</div>
@endsection

@section('vendor-script')
<script src="{{asset('vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
<script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
@endsection

@section('page-script')
<script src="{{ asset(mix('js/scripts/pages/app-user-view-security.js')) }}"></script>
<script src="{{ asset(mix('js/scripts/pages/modal-two-factor-auth.js')) }}"></script>
<script src="{{ asset(mix('js/scripts/pages/modal-edit-user.js')) }}"></script>
<script src="{{asset('js/scripts/pages/auth-register.js')}}"></script>
<script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
@endsection

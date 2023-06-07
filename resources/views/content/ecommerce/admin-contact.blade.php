@extends('layouts/detachedLayoutMaster')
    @section('title', 'Contact')
        @section('vendor-style')
        <!-- Vendor css files -->
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/spinner/jquery.bootstrap-touchspin.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/swiper.min.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/wizard/bs-stepper.min.css')) }}">
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" id="theme-styles">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
        @endsection
        @section('page-style')
        <!-- Page css files -->

        <link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-ecommerce-details.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-number-input.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-wizard.css')) }}">
        @endsection
    


    @section('vendor-script')
        <!-- Vendor js files -->
        <script src="{{ asset(mix('vendors/js/forms/spinner/jquery.bootstrap-touchspin.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/extensions/swiper.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/forms/wizard/bs-stepper.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
        
    @endsection
    @section('content')
    @foreach ($comments as $comment)
        
    <div class="card">
            @php
                $name = $comment->name;
                $nameParts = explode(" ", $name); // Split the name into an array of first and last name

$firstNameInitial = substr($nameParts[0], 0, 1); // Extract the first letter of the first name
$lastNameInitial = ""; // Initialize the last name initial

if (isset($nameParts[1])) {
    $lastNameInitial = substr($nameParts[1], 0, 1); // Extract the first letter of the last name
}

$firstNameInitial = strtoupper($firstNameInitial); // Convert the first name's first letter to uppercase
$lastNameInitial = strtoupper($lastNameInitial); // Convert the last name's first letter to uppercase

// Concatenate the initials
$initials = $firstNameInitial . $lastNameInitial;
            @endphp
        <div class="card-body">
          <div class="d-flex align-items-start">
            <div class="avatar bg-light-primary me-75">
                <div class="avatar-content">{{$initials}}</div>
            </div>
           
            <div class="author-info">
              <h6 class="fw-bolder mb-25">{{$comment->name}} <span class="text-muted ms-50 me-25">|</span>
                <small class="text-muted">{{$comment->created_at}}</small></h6>
              <small class="text-muted">{{$comment->email}}</small>
              <p class="card-text">
                {{$comment->comment}}
              </p>
              <a href="#">
                {{-- <div class="d-inline-flex align-items-center">
                  <i data-feather="corner-up-left" class="font-medium-3 me-50"></i>
                  <span>Reply</span>
                </div> --}}
              </a>
            </div>
          </div>
        </div>
      </div>
        
        @endforeach
        <section id="ecommerce-pagination ">
            <div class="row">
              <div class="col-sm-12">
                <nav id="pagination" aria-label="Page navigation example">
        
        
                  {{$comments->withQueryString()->links('pagination::bootstrap-5')}}
                </nav>
              </div>
            </div>
          </section>

    @endsection
    @section('page-script')
    <!-- Page js files -->
    
    <script src="{{ asset(mix('js/scripts/pages/app-ecommerce-details.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/forms/form-number-input.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/forms/form-wizard.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>

    @endsection

    
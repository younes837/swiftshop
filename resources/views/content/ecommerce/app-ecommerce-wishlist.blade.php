@extends('layouts/detachedLayoutMaster')

@section('title', 'WishList')

@section('vendor-style')
  <!-- Vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />
@endsection
@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-ecommerce.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
@endsection

@section('content')
<!-- Wishlist Starts -->
<section id="wishlist" class="grid-view wishlist-items">
  @include('content/ecommerce/wishlist-content')
  
</section>
<input type="hidden" name="hidden_page" id="hidden_page" value="1" />
@if(Auth::check())
<section id="ecommerce-pagination ">
  <div class="row">
    <div class="col-sm-12">
      <nav id="pagination" aria-label="Page navigation example">

 
        {{$produits->withQueryString()->links('pagination::bootstrap-5')}}
      </nav>
    </div>
  </div>
</section>
@endif
<!-- Wishlist Ends -->

{{-- <script type="text/javascript">
  function fetch_data(page)
  {
   $.ajax({
    url:'/app/ecommerce/wishlist-details?page='+page,
    success:function(data)
    {
      console.log(data);
      $('.wishlist-items').html(data);
      feather.replace();
      
     
    }
   });
  }
  $(document).on('click', '.pagination a', function(event){
 event.preventDefault(); 
 var page = $(this).attr('href').split('page=')[1];
 $('#hidden_page').val(page);
 console.log(page);

 fetch_data(page);
});
          
        



  
  
  </script> --}}
@endsection

@section('vendor-script')
  <!-- Vendor js files -->
  <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
@endsection
@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset(mix('js/scripts/pages/app-ecommerce-wishlist.js')) }}"></script>
@endsection



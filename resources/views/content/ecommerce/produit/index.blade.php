@extends('layouts/detachedLayoutMaster')
    @section('title', 'Shop')
        @section('vendor-style')
        <!-- Vendor css files -->
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/spinner/jquery.bootstrap-touchspin.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/swiper.min.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />
        <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
            <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" id="theme-styles">
        @endsection
        @section('page-style')
        <!-- Page css files -->
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-ecommerce-details.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-number-input.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">

        @endsection



    @section('vendor-script')
        <!-- Vendor js files -->
        <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/forms/spinner/jquery.bootstrap-touchspin.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/swiper.min.js')) }}"></script>
    @endsection
    @section('content')
        <!-- Hoverable rows start -->


<div class="row" id="table-hover-row">
            @if ($errors->any())
                    <input type="hidden" id="error" value="{{ $errors->first() }}">
                    <script>
                    $(document).ready(function () {
                    Swal.fire('Error',$('#error').val(),'error',{

                confirmButtonClass: 'btn btn-primary',
                buttonsStyling: !1
                });
            });
                </script>

            @endif
            @if(Session::has('succes'))
                <script>
                    $(document).ready(function () {
                    Swal.fire('Succes!','product Addes Successfully!','success',{

                confirmButtonClass: 'btn btn-primary',
                buttonsStyling: !1
                });
                });
                </script>
                @endif
            @if(Session::has('update'))
                <script>
                $(document).ready(function () {
                Swal.fire('Succes!','User Updated Successfully!','success',{

                confirmButtonClass: 'btn btn-primary',
                buttonsStyling: !1
            });
            });
                </script>
            @endif
            @if(Session::has('delete'))
                    <script>
                    $(document).ready(function () {
                    Swal.fire('Succes!','User Deleted Successfully!','success',{

                    confirmButtonClass: 'btn btn-primary',
                    buttonsStyling: !1
                });
                });
                    </script>
                @endif
    <div class="col-12">
      <div class="card">
        



        <div class="mb-2 row mt-1">
            <!-- Button trigger modal -->
           <div class="col-8 "> </div>
            <div class="col-2 mb-2 d-flex justify-content-end">
              <form action="{{url('/filter_categorie')}}" method="GET">

                <select class="form-select" name="filter_categorie" onchange="this.form.submit()"  id="select-categorie">
                  <option value="all">All</option>
                  @foreach ($categories as $categorie)
                  <option @if ( isset($id))
                  @if ($id==$categorie->id)
                      
                  selected
                  @endif
                  @endif value="{{$categorie->id}}">{{$categorie->name}}</option>
                  @endforeach
                </select>
              </form>
            </div>
            <div class="col-2 mb-2 d-flex justify-content-start">
            <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#large">
              Add Product
            </button>
          </div>
          <div>
            <!-- Modal -->
            <div
              class="modal fade text-start"
              id="large"
              tabindex="-1"
              aria-labelledby="myModalLabel17"
              aria-hidden="true"
            >
              <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                  <div class="modal-header">

                    <h4 class="modal-title" id="myModalLabel17">ajout d'un produit</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form class="form" method="POST" action="{{route('product.store')}}" enctype="multipart/form-data">
                        @csrf
                      <div class="row">
                        <div class="col-md-6 col-12">
                          <div class="form-group">
                            <label for="first-name-column">libelle</label>
                            <input
                              type="text"
                              id="first-name-column"
                              class="form-control"
                              placeholder="libelle"
                              name="libelle"
                            />
                          </div>
                        </div>
                        <div class="col-md-6 col-12">
                          <div class="form-group">
                            <label for="last-name-column">photo</label>
                            <input
                              type="file"
                              id="last-name-column"
                              class="form-control"
                              placeholder="inserer une photo"
                              name="photo"
                            />
                          </div>
                        </div>
                        <div class="col-md-6 col-12">
                          <div class="form-group">
                            <label for="city-column">descreption</label>
                            <input type="text" id="descreption-column" class="form-control" placeholder="descreption" name="description" />
                          </div>
                        </div>
                        <div class="col-md-6 col-12">
                          <div class="form-group">
                            <label for="country-floating">stock</label>
                            <input
                              type="number"
                              id="stock-floating"
                              class="form-control"
                              name="stock"
                              placeholder="stock"
                            />
                          </div>
                        </div>
                        <div class="col-md-6 col-12">
                          <div class="form-group">
                            <label for="company-column">rating</label>
                            <input
                              type="number"
                              id="rating-column"
                              class="form-control"
                              max=5
                              name="rating"
                              placeholder="rating"
                            />
                          </div>
                        </div>
                        <div class="col-md-6 col-12">
                          <div class="form-group">
                            <label for="email-id-column">price</label>
                            <input
                              type="price"
                              id="price-id-column"
                              class="form-control"
                              name="price"
                              placeholder="price"
                            />
                          </div>
                        </div>
                      <div class="col-md-6 col-12">
                        <label class="form-label" for="selectDefault">categorie</label>
                        <select class="form-select " name="categorie" id="selectDefault">
                            <option value=""></option>
                                    @foreach($categories as $categorie)
                                    <option value="{{$categorie->id}}">{{$categorie->name}}</option>
                                    @endforeach
                            </select>
                    </div>
                    <div class="col-md-6 col-12">
                        <label class="form-label" for="selectDefault">propriete</label>
                        <select class="form-select " name="propriete" id="selectDefault">
                            <option value=""></option>
                                    @foreach($proprietes as $propriete)
                                    <option value="{{$propriete->id}}">{{$propriete->libelle}}</option>
                                    @endforeach
                            </select>
                    </div>
                    <div class="col-md-6 col-12">
                        <label class="form-label" for="selectDefault">brand</label>
                        <select class="form-select " name="brand" id="selectDefault">
                            <option value=""></option>
                                    @foreach($brands as $brand)
                                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                                    @endforeach
                            </select>
                    </div>

                    </div>
                      <div class="modal-footer">
                        <button type="submit" rippleEffect class="btn btn-primary mr-1">Submit</button>
                        <button type="reset" rippleEffect class="btn btn-outline-secondary">Reset</button>
                      </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <!-- kkkkkkkkkkk -->
        <div class="table-responsive">
          <table class="table table-hover text-center">
          <thead>
            <tr>
              <th scope="col">photo</th>
            <th scope="col">libelle</th>
            <th scope="col">stock</th>
            <th scope="col">raiting</th>
            <th scope="col">price</th>
            <th scope="col">categorie</th>
            <th scope="col">propriete</th>
            <th scope="col">brand</th>
            <th scope="col">action</th>
            </tr>
        </thead>
          <tbody>
                @foreach($products as $product)
                    <tr>
                      <td scope="row"><img src="{{asset($product->photo)}}" width="80" heghit="80"></td>
                    <td scope="row">{{$product->libelle}}</td>
                    <td scope="row">{{$product->stock}}</td>
                    <td scope="row">{{$product->rating}}</td>
                    <td scope="row">${{$product->price}}</td>
                    <td scope="row">{{App\Models\Categorie::where('id',$product->categorie_id)->select('name')->first()->name}}</td>
                    <td scope="row">{{App\Models\propriete::where('id',$product->propriete_id)->select('libelle')->first()->libelle}}</td>
                    <td scope="row">{{App\Models\Brand::where('id',$product->brand_id)->select('name')->first()->name}}</td>

                    <td><div class="dropdown">
                  <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                    <i data-feather="more-vertical"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="{{ route('product.edit', $product->id) }}">
                      <i data-feather="edit-2" class="me-50"></i>
                      <span>Edit</span>
                    </a>

                    <a href="{{ route('product.destroy', $product->id) }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $product->id }}').submit();">
                                  <i data-feather="trash" class="me-50"></i>
                                  <span>Delete</span>
                                </a>
                              <form id="delete-form-{{ $product->id }}" action="{{ route('product.destroy', $product->id) }}" method="POST" style="display: none;">
                                  @csrf
                                  @method('DELETE')
                              </form>
                  </div>
                </div>
            </td>
                    </tr>
                    @endforeach
          </tbody>
          </table>
        </div>
      </div>
    </div>

    <section id="ecommerce-pagination ">
    <div class="row">
      <div class="col-sm-12">
        <nav id="pagination" aria-label="Page navigation example">


          {{$products->withQueryString()->links('pagination::bootstrap-5')}}
        </nav>
      </div>
    </div>
  </section>
  <script type="text/javascript">



  </script>

  </div>
    @endsection
    @section('page-script')


    <!-- Page js files -->
    <script src="{{ asset(mix('js/scripts/pages/app-ecommerce-details.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-number-input.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
    @endsection



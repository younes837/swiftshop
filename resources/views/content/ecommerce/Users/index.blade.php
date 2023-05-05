@extends('layouts/detachedLayoutMaster')
    @section('title', 'Shop')
        @section('vendor-style')
        <!-- Vendor css files -->
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/spinner/jquery.bootstrap-touchspin.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/swiper.min.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/wizard/bs-stepper.min.css')) }}">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />
        @endsection
        @section('page-style')
        <!-- Page css files -->
        <link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-ecommerce-details.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-number-input.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
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
        <!-- Hoverable rows start -->
<div class="row" id="table-hover-row">
    <div class="col-12">
      @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Users List</h4>
        </div>
        <div class="card-body">
          <div class="modal-size-lg ">
            <!-- Button trigger modal -->
            <div class="d-flex justify-content-end pb-2">
              <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#large">
                Add User
              </button>
            </div>
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
                    <h4 class="modal-title" id="myModalLabel17">Add User</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form class="form" action="{{route('Users.store')}}" method="POST" enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <div class="row">
                        <div class="col-md-6 col-12">
                          <div class="form-group">
                            <label for="first-name-column">  Name</label>
                            <input
                              type="text"
                              id="first-name-column"
                              class="form-control"
                              placeholder="Name"
                              name="name"
                            />
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
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
                            />
                            @if ($errors->has('email'))
                              <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                          </div>
                        </div>
                        <div class="col-md-6 col-12">
                          <div class="form-group">
                            <label for="city-column">avatar</label>
                            <input type="file" id="city-column" class="form-control" placeholder="City" name="avatar" />
                          </div>
                        </div>
                        <div class="col-md-6 col-12">
                          <div class="form-group">
                            <label for="country-floating">Password</label>
                            <input
                              type="Password"
                              id="country-floating"
                              class="form-control"
                              name="password"
                              placeholder="Password"
                            />
                            @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                          @endif
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
                            />
                            @if ($errors->has('address'))
                            <span class="text-danger">{{ $errors->first('address') }}</span>
                          @endif
                          </div>
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
                            />
                            @if ($errors->has('phone'))
                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                          @endif
                          </div>
                        </div>
                        <div class="col-md-6 col-12">
                          <label class="form-label" for="select2-basic">City</label>
                          <select class="select2 form-select form-control" name="ville" id="select2-basic">
                            @foreach ($villes as $ville)
                            <option value="{{$ville->id}}">{{$ville->name}}</option>
                            @endforeach
                          </select>
                          @if ($errors->has('ville'))
                          <span class="text-danger">{{ $errors->first('ville') }}</span>
                        @endif
                        </div>
                        <div class="col-md-6 col-12">
                          <label class="form-label" for="selectDefault">Role</label>
                          <select class="form-select " name="role" id="selectDefault">
                              <option value=""></option>
                                      @foreach($roles as $role)
                                      <option value="{{$role->id}}">{{$role->libelle}}</option>
                                      @endforeach
                              </select>
                              @if ($errors->has('role'))
                              <span class="text-danger">{{ $errors->first('role') }}</span>
                            @endif
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
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Avatar</th>
                <th>Username</th>
                <th>Email</th>
                <th>Adress</th>
                <th>Phone-Number</th>
                <th>Role</th>
                <th>City</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>
                            <span class="avatar">
                                <img class="round"
                                  src="{{asset('images/'.$user->avatar )}}"
                                  alt="avatar" height="40" width="40">
                            </span>
                        </td>
                        <td>
                            {{$user->name}}
                        </td>
                        <td>
                            {{$user->email}}
                        </td>
                        <td>
                            {{$user->adress}}
                        </td>
                        <td>
                            {{$user->phone}}
                        </td>
                        @if ($user->role_id == 1)
                            <td >
                                <span class="badge rounded-pill badge-light-success">Admin</span>
                            </td>
                        @else
                            <td>
                                <span class="badge rounded-pill badge-light-info">User</span>
                            </td>
                        @endif
                        <td>
                            {{App\Models\Ville::where('id',$user->ville_id)->select('name')->first()->name}}
                        </td>
                        <td>
                            <div class="dropdown">
                              <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                                <i data-feather="more-vertical"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editUser{{$user->id}}">
                                  <i data-feather="edit-2" class="me-50"></i>
                                  <span>Edit</span>
                                </a>                                
                                <a href="{{ route('Users.destroy', $user->id) }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $user->id }}').submit();">
                                  <i data-feather="trash" class="me-50"></i>
                                  <span>Delete</span>
                                </a>
                              <form id="delete-form-{{ $user->id }}" action="{{ route('Users.destroy', $user->id) }}" method="POST" style="display: none;">
                                  @csrf
                                  @method('DELETE')
                              </form>
                              </div>
                            </div>
                        </td>
                      </tr>
                      <div class="modal fade" id="editUser{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="editUserLabel{{$user->id}}" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user" role="document">
                          <div class="modal-content">
                            <div class="modal-header bg-transparent">
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body pb-5 px-sm-5 pt-50">
                              <div class="text-center mb-2">
                                <h1 class="mb-1">Edit User Information</h1>
                              </div>
                              {{-- start avatar --}}
                              <div class="user-avatar-section">
                                <div class="d-flex align-items-center flex-column">
                                  <img
                                    class="img-fluid rounded mt-1 mb-2"
                                    src="{{asset('images/'.$user->avatar )}}"
                                    height="110"
                                    width="110"
                                    alt="User avatar"
                                  />
                                  <div class="user-info text-center">
                                    <h4>{{$user->name}}</h4>
                                    @if ($user->role_id == 1)
                                      <span class="badge rounded-pill badge-light-success">Admin</span>
                                    @else
                                      <span class="badge rounded-pill badge-light-info">User</span>
                                    @endif
                                  </div>
                                </div>
                              </div>
                              {{-- end avatar --}}

                              <form class="form" action="{{route('Users.update',$user->id)}}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                @method("PUT")
                                <div class="row">
                                  <div class="col-md-6 col-12">
                                    <div class="form-group">
                                      <label for="first-name-column">  Name</label>
                                      <input
                                        type="text"
                                        id="first-name-column"
                                        class="form-control"
                                        placeholder="Name"
                                        name="name"
                                        value="{{$user->name}}"
                                      />
                                      @if ($errors->has('name'))
                                          <span class="text-danger">{{ $errors->first('name') }}</span>
                                      @endif
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
                                      />
                                      @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                      @endif
                                    </div>
                                  </div>
                                  <div class="col-md-6 col-12">
                                    <div class="form-group">
                                      <label for="city-column">avatar</label>
                                      <input type="file" id="city-column" class="form-control" placeholder="City" name="avatar" />
                                    </div>
                                  </div>
                                  <div class="col-md-6 col-12">
                                    <div class="form-group">
                                      <label for="country-floating">Password</label>
                                      <input
                                        type="Password"
                                        id="country-floating"
                                        class="form-control"
                                        name="password"
                                        placeholder="Password"
                                        {{-- value="{{$user->password}}" --}}
                                      />
                                      @if ($errors->has('password'))
                                      <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
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
                                      @if ($errors->has('address'))
                                      <span class="text-danger">{{ $errors->first('address') }}</span>
                                    @endif
                                    </div>
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
                                        value="{{$user->phone}}"
                                      />
                                      @if ($errors->has('phone'))
                                      <span class="text-danger">{{ $errors->first('phone') }}</span>
                                    @endif
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
                                    <label class="form-label" for="selectDefault">Role</label>
                                    <select class="form-select " name="role" id="selectDefault">
                                      <option value="">-- Select a Role --</option>
                                      @foreach ($roles as $role)
                                          <option value={{$role->id}}>{{$role->libelle}}</option>
                                      @endforeach
                                      @if ($errors->has('role'))
                                        <span class="text-danger">{{ $errors->first('role') }}</span>
                                      @endif
                                    </select>
                                  </div>
                                  <div class="col-md-6 col-12">
                                    <label class="form-label" for="selectDefault">City</label>
                                    <select class="form-select " name="ville" id="selectDefault">
                                      <option value="">-- Select a City --</option>
                                      @foreach ($villes as $ville)
                                      <option value={{$ville->id}}>{{$ville->name}}</option>
                                      @endforeach
                                      @if ($errors->has('role'))
                                        <span class="text-danger">{{ $errors->first('role') }}</span>
                                      @endif
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
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <section id="ecommerce-pagination ">
        <div class="row">
          <div class="col-sm-12">
            <nav id="pagination" aria-label="Page navigation example">
              {{$users->withQueryString()->links('pagination::bootstrap-5')}}
            </nav>
          </div>
        </div>
      </section>
      <!--/ Edit User Modal -->
      
    </div>

  </div>
    @endsection
    @section('page-script')
    <!-- Page js files -->
    <script src="{{ asset(mix('js/scripts/pages/app-ecommerce-details.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/forms/form-number-input.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/forms/form-wizard.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
    @endsection
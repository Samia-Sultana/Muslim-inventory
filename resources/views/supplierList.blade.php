<x-admin-layout>

    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Supplier List</h4>
                    <h6>Manage your Supplier</h6>
                </div>
                <div class="page-btn">
                    <a href="{{route('addSupplierPage')}}" class="btn btn-added"><img src="{{asset('assets/img/icons/plus.svg')}}" alt="img">Add Supplier</a>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-top">
                        <div class="search-set">
                            <div class="search-path">
                                <a class="btn btn-filter" id="filter_search">
                                    <img src="{{asset('assets/img/icons/filter.svg')}}" alt="img">
                                    <span><img src="{{asset('assets/img/icons/closes.svg')}}" alt="img"></span>
                                </a>
                            </div>
                            <div class="search-input">
                                <a class="btn btn-searchset"><img src="{{asset('assets/img/icons/search-white.svg')}}" alt="img"></a>
                            </div>
                        </div>

                    </div>

                    <div class="card" id="filter_inputs">
                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="col-lg-2 col-sm-6 col-12">
                                    <div class="form-group">
                                        <input type="text" placeholder="Enter Supplier Code">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-sm-6 col-12">
                                    <div class="form-group">
                                        <input type="text" placeholder="Enter Supplier">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-sm-6 col-12">
                                    <div class="form-group">
                                        <input type="text" placeholder="Enter Phone">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-sm-6 col-12">
                                    <div class="form-group">
                                        <input type="text" placeholder="Enter Email">
                                    </div>
                                </div>
                                <div class="col-lg-1 col-sm-6 col-12 ms-auto">
                                    <div class="form-group">
                                        <a class="btn btn-filters ms-auto"><img src="{{asset('assets/img/icons/search-whites.svg')}}" alt="img"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table datanew">
                            <thead>
                                <tr>
                                    <th>
                                        <label class="checkboxs">
                                            <input type="checkbox" id="select-all">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </th>
                                    <th>Supplier Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Company</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($suppliers)
                                @foreach($suppliers as $supplier)
                                <tr>
                                    <td>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </td>
                                    <td class="productimgname">{{$supplier->name}}</td>
                                    <td>{{$supplier->phone}}</td>
                                    <td>{{$supplier->email}}</td>
                                    <td>{{$supplier->address}}</td>
                                    <td>{{$supplier->company_name}}</td>
                                    <td>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="{{'#update_supplier_'.$supplier->id}}">
                                        <img src="{{asset('assets/img/icons/edit.svg')}}" alt="img">
                                        </button>
                                        <div class="modal fade" id="{{'update_supplier_' . $supplier->id}}" tabindex="-1" role="dialog" aria-labelledby="update_product_lebel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="update_supplier_lebel">Update Supplier</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" action="{{route('updateSupplier')}}" class="d-flex">
                                                            @csrf
                                                            <div class="p-1">
                                                                <input type="hidden" id="update_supplierId" name="update_supplierId" value="{{$supplier->id}}">
                                                                <input type="text" id="update_name" name="update_name" value="{{$supplier->name}}"><br><br>
                                                                <input type="email" id="update_email" name="update_email" value="{{$supplier->email}}"><br><br>
                                                                <input type="text" id="update_phone" name="update_phone" value="{{$supplier->phone}}"><br><br>
                                                                <input type="text" id="update_address" name="update_address" value="{{$supplier->address}}"><br><br>
                                                                <input type="text" id="update_company" name="update_company" value="{{$supplier->company_name}}"><br><br>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary btn-update-supplier">Save changes</button>
                                                            </div>

                                                        </form>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal -->
                                        <form action="{{route('deleteSupplier')}}" method="post">
                                            @csrf
                                            <input type="hidden" value="{{$supplier->id}}" name="supplier_id">
                                            <button type="submit" class="btn btn-danger btn-delete-supplier"><img src="{{asset('assets/img/icons/delete.svg')}}" alt="img"></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                @endif


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!------<table class="table table-bordered">
        <thead>
            <th>id</th>
            <th>name</th>
            <th>update</th>
            <th>delete</th>
        </thead>
        <tbody>
            @if($suppliers)
            @foreach($suppliers as $supplier)
            <tr>
                <td>{{$supplier->id}}</td>
                <td>{{$supplier->name}}</td>

                <td>
                    
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="{{'#update_supplier_'.$supplier->id}}">
                        Update
                    </button>
                    <div class="modal fade" id="{{'update_supplier_' . $supplier->id}}" tabindex="-1" role="dialog" aria-labelledby="update_product_lebel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="update_supplier_lebel">Update Supplier</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{route('updateSupplier')}}" class="d-flex">
                                        @csrf
                                        <div class="p-1">
                                            <input type="hidden" id="update_supplierId" name="update_supplierId" value="{{$supplier->id}}">
                                            <input type="text" id="update_name" name="update_name" value="{{$supplier->name}}"><br><br>
                                            <input type="email" id="update_email" name="update_email" value="{{$supplier->email}}"><br><br>
                                            <input type="text" id="update_phone" name="update_phone" value="{{$supplier->phone}}"><br><br>
                                            <input type="text" id="update_address" name="update_address" value="{{$supplier->address}}"><br><br>
                                            <input type="text" id="update_company" name="update_company" value="{{$supplier->company_name}}"><br><br>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary btn-update-supplier">Save changes</button>
                                        </div>

                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>

                

                </td>

                <td>
                    <form action="{{route('deleteSupplier')}}" method="post">
                        @csrf
                        <input type="hidden" value="{{$supplier->id}}" name="supplier_id">
                        <button type="submit" class="btn btn-danger btn-delete-supplier">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table> --------------->
    <!-------modal cdn -------------->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-------modal cdn end-------------->
    <!-------toaster cdn -------------->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"> </script>
    <script>
        @if(Session::has('message'))
        var type = "{{ Session::get('alert-type','info') }}"
        switch (type) {
            case 'info':
                toastr.info(" {{ Session::get('message') }} ");
                break;
            case 'success':
                toastr.success(" {{ Session::get('message') }} ");
                break;
            case 'warning':
                toastr.warning(" {{ Session::get('message') }} ");
                break;
            case 'error':
                toastr.error(" {{ Session::get('message') }} ");
                break;
        }
        @endif
    </script>
</x-admin-layout>
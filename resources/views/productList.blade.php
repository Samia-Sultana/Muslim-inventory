<x-admin-layout>
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Product List</h4>
                    <h6>Manage your products</h6>
                </div>
                <div class="page-btn">
                    <a href="{{route('addProductPage')}}" class="btn btn-added"><img src="{{asset('assets/img/icons/plus.svg')}}" alt="img" class="me-1">Add New Product</a>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="product-list">
                            <thead>
                                <tr>
                                    <th>
                                        <label class="checkboxs">
                                            <input type="checkbox" id="select-all">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </th>
                                    <th>Product Name</th>
                                    <th>Token number</th>
                                    <th>Thumbnail</th>
                                    <th>Carat</th>
                                    <th>gm/weight</th>
                                    <th>Bangla Weight</th>

                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($products)
                                @foreach($products as $product)
                                <tr>
                                    <td>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </td>
                                    <td class="productimgname">
                                        {{$product->name}}
                                    </td>
                                    <td>
                                        {{$product->sku}}
                                    </td>
                                    <!-- <td>Computers</td>
                                        <td>N/D</td>
                                        <td>1500.00</td>
                                        <td>pc</td>
                                        <td>100.00</td> -->
                                    <td>
                                        <img src="{{url('photos/'. $product->thumbnail)}}" alt="product_image" height="80px" width="150px">
                                    </td>
                                    <td>
                                        {{$product->carat}}
                                    </td>
                                    <td>
                                        {{$product->weight}}
                                    </td>
                                    <td>
                                        {{$product->bangla_weight}}
                                    </td>
                                   
                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="{{'#update_product_'.$product->id}}">
                                            <img src="{{asset('assets/img/icons/edit.svg')}}" alt="img">
                                        </button>
                                        <div class="modal fade" id="{{'update_product_' . $product->id}}" tabindex="-1" role="dialog" aria-labelledby="update_product_lebel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="update_product_lebel">Update product</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" action="{{route('updateProduct')}}" enctype="multipart/form-data" class="d-flex">
                                                            @csrf
                                                            <div class="p-1">
                                                                <input type="hidden" id="update_productId" name="update_productId" value="{{$product->id}}">
                                                                <input type="text" id="update_name" name="update_name" value="{{$product->name}}"><br><br>
                                                                <input type="text" id="update_sku" name="update_sku" value="{{$product->sku}}"><br><br>
                                                                <input type="file" id="update_thumbnail" name="update_thumbnail"><br><br>
                                                                <input type="text" id="update_carat" name="update_carat" value="{{$product->carat}}"><br><br>
                                                                <input type="text" id="update_weight" name="update_weight" value="{{$product->weight}}"><br><br>
                                                                <input type="text" id="update_bangla_weight" name="update_bangla_weight" value="{{$product->bangla_weight}}"><br><br>
                                                                
                                                                

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary btn-update-product">Save changes</button>
                                                            </div>

                                                        </form>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <form action="{{route('deleteProduct')}}" method="post">
                                            @csrf
                                            <input type="hidden" value="{{$product->id}}" name="product_id">
                                            <button type="submit" class="btn btn-danger btn-delete-product">
                                                <img src="{{asset('assets/img/icons/delete.svg')}}" alt="img">
                                            </button>
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

@php
use Illuminate\Support\Facades\Request;
@endphp

<x-admin-layout>
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Product List</h4>
                    <h6>Manage your products</h6>
                </div>
                @php
            $currentUrl = Request::url();
            @endphp
                <div class="page-btn">
                @if(strpos($currentUrl, 'diamond') !== false)
                <a href="{{route('addProductPageDiamond')}}" class="btn btn-added"><img src="{{asset('assets/img/icons/plus.svg')}}" alt="img" class="me-1">Add New Product</a>

                @elseif(strpos($currentUrl, 'diamond') == false)
                <a href="{{route('addProductPage')}}" class="btn btn-added"><img src="{{asset('assets/img/icons/plus.svg')}}" alt="img" class="me-1">Add New Product</a>

                @endif
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
                                    <th>Gold weight</th>
                                    <th>Diamond Weight</th>
                                    <th>Diamond Piece</th>

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
                                        {{$product->gold_weight}}
                                    </td>
                                    <td>
                                        {{$product->diamond_weight}}
                                    </td>
                                    <td>
                                        {{$product->diamond_piece}}
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

                                                        @if(strpos($currentUrl, 'diamond') !== false)
                                                        <form method="POST" action="{{route('updateProductDiamond')}}" enctype="multipart/form-data" class="d-flex">

                                                            @elseif(strpos($currentUrl, 'diamond') == false)
                                                            <form method="POST" action="{{route('updateProduct')}}" enctype="multipart/form-data" class="d-flex">
                                                                @endif

                                                                @csrf
                                                                <div class="p-1">
                                                                    <input type="hidden" id="update_productId" name="update_productId" value="{{$product->id}}">
                                                                    <input type="text" id="update_name" name="update_name" value="{{$product->name}}"><br><br>
                                                                    <input type="text" id="update_sku" name="update_sku" value="{{$product->sku}}"><br><br>
                                                                    <input type="file" id="update_thumbnail" name="update_thumbnail"><br><br>
                                                                    <input type="text" id="update_gold_weight" name="update_gold_weight" value="{{$product->gold_weight}}"><br><br>
                                                                    <input type="text" id="update_diamond_weight" name="update_diamond_weight" value="{{$product->diamond_weight}}"><br><br>
                                                                    <input type="text" id="update_diamond_piece" name="update_diamond_piece" value="{{$product->diamond_piece}}"><br><br>



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
                                        @if(strpos($currentUrl, 'diamond') !== false)
                                        <form action="{{route('deleteProductDiamond')}}" method="post">
                                        @elseif(strpos($currentUrl, 'diamond') == false)
                                        <form action="{{route('deleteProduct')}}" method="post">
                                        @endif                                            
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
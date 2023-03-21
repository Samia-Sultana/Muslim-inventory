@php
use Illuminate\Support\Facades\Request;
@endphp


<x-admin-layout>

    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Product Add</h4>
                    <h6>Create new product</h6>
                </div>
            </div>
            @php
            $currentUrl = Request::url();
            @endphp
            @if(strpos($currentUrl, 'diamond') !== false)
            <form enctype="multipart/form-data" method="POST" action="{{ route('addProductDiamond') }}" class="d-flex">
            @elseif(strpos($currentUrl, 'diamond') == false)
            <form enctype="multipart/form-data" method="POST" action="{{ route('addProduct') }}" class="d-flex">
            @endif
                @csrf
                <div class="card">
                    <div class="card-body">
                        <form action="" class="was-validated">
                            <div class="row">
                                <div class="col-lg-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="validationServer03">Product Name*</label>
                                        <input type="text" class="form-control is-invalid" id="name" name="name" required>
                                        <div class="invalid-feedback"></div>

                                    </div>
                                </div>
                                <!-- <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Category</label>
                                    <select class="select">
                                        <option>Choose Category</option>
                                        <option>Computers</option>
                                    </select>
                                </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Sub Category</label>
                                        <select class="select">
                                            <option>Choose Sub Category</option>
                                            <option>Fruits</option>
                                        </select>
                                    </div>
                                </div> -->
                                <div class="col-lg-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="validationServer10">Token Number*</label>
                                        <input type="text" class="form-control is-invalid" name="sku" id="sku" required>
                                        <div class="invalid-feedback"></div>

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Product Image*</label>

                                        <input type="file" class="form-control" aria-label="file example" id="thumbnail" name="thumbnail" required>
                                        <div class="invalid-feedback"></div>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <!-- case image -->
                                    <img id="showThumbnail" src="" width="100" height="100">

                                </div>
                                @if(strpos($currentUrl, 'diamond') == false)
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Gold weight(GWT)*</label>

                                        <input type="text" class="form-control" aria-label="file example" id="gold_weight" name="gold_weight" required>
                                        <div class="invalid-feedback"></div>

                                    </div>
                                </div>

                                @elseif(strpos($currentUrl, 'diamond') !== false)
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Diamond Weight(DWT)*</label>

                                        <input type="text" class="form-control" aria-label="file example" id="diamond_weight" name="diamond_weight" required>
                                        <div class="invalid-feedback"></div>

                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Diamond Piece*</label>

                                        <input type="text" class="form-control" aria-label="file example" id="diamond_piece" name="diamond_piece" required>
                                        <div class="invalid-feedback"></div>

                                    </div>
                                </div>
                                @endif
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Comments</label>
                                        <textarea class="form-control" id="description" name="description"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <button class="btn btn-submit me-2" type="submit">Submit</button>

                                </div>
                        </form>
                    </div>
                </div>
            </form>
        </div>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

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
    <script type="text/javascript">
        $(document).ready(function() {
            $('#thumbnail').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showThumbnail').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>

</x-admin-layout>
<x-admin-layout>


    <form enctype="multipart/form-data" method="POST" action="{{ route('addPurchase') }}">
        @csrf
        <div class="page-wrapper">
            <div class="content">
                <div class="page-header">
                    <div class="page-title">
                        <h4>Purchase Add</h4>
                        <h6>Add/Update Purchase</h6>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Supplier*</label>
                                    <div class="row">
                                        <div class="col-lg-10 col-sm-10 col-10">
                                            <select class="select" name="supplier" id="supplier" required>
                                                @if($suppliers)
                                                @foreach($suppliers as $supplier)
                                                <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Purchase Date </label>
                                    <div class="input-groupicon">
                                        <input type="text" placeholder="DD-MM-YYYY" class="datetimepicker" name="purchase_date">
                                        <div class="addonset">
                                            <img src="assets/img/icons/calendars.svg" alt="img">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Batch No</label>
                                    <input type="text" name="batch_no">
                                </div>
                            </div>
                            <div class="row  text-center">
                                <div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                            <br>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-wrapper" style="padding-top: 0px !important;" id="product-information-container">
            <div class="content product-information" style="padding-top: 0px !important;padding-bottom: 0px !important;">
                <!-- Existing content goes here -->
                <div class="card">
                    <div class="card-body">

                        <div class="row">

                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Product Name*</label>
                                    <input type="text" name="name[]">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Token Number*</label>
                                    <input type="text" name="token[]">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-12 thumbnail-section">
                                <div class="form-group">
                                    <label>Product Thumbnail*</label>
                                    <input type="file" class="form-control" aria-label="file example" id="thumbnail" name="thumbnail[]" required="" onchange="previewImage(this)">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <!-- case image -->
                                    <img class="preview-image" id="showThumbnail" src="" width="100" height="100">

                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>gm/weight*</label>
                                    <input type="text" name="weight[]">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Bangla weight*</label>
                                    <input type="text" name="bangla_weight[]">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Carat*</label>
                                    <input type="text" name="carat[]">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Buying Price*</label>
                                    <input type="text" name="buying_price[]">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Total Quantity*</label>
                                    <input type="text" name="total_qty[]">
                                </div>
                            </div>


                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-1" style="float: right;">
            <div>
                <button type="button" class="btn btn-primary" id="add-more-button">Add More</button>
            </div>
        </div>





    </form>














    <!-------modal cdn -------------->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-------modal cdn end-------------->
    <!-------toaster cdn -------------->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"> </script>

    <script>
         function previewImage(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $(input).parents(".thumbnail-section").siblings().find('.preview-image').attr('src', e.target.result);;
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
        $(document).ready(function() {

           

            $('#add-more-button').click(function() {

                var productInformation = $('#product-information-container .product-information:first').clone();
                console.log(productInformation);
                $(productInformation).find('input').val('');
                $(productInformation).find('.preview-image').attr('src', '');
                $('#product-information-container').append(productInformation);
            });
        });
    </script>



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
    <!-------end toaster cdn -------------->

</x-admin-layout>
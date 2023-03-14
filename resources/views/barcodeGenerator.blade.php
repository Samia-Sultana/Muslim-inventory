<x-admin-layout>

<div class="page-wrapper">
            <div class="content">
                <div class="page-header">
                    <div class="page-title">
                        <h4>Print Barcode</h4>
                        <h6>Print product barcodes</h6>
                    </div>
                </div>

              <form action="{{route('generateBarcode')}}" method="POST">
                @csrf
              <div class="card">
                    <div class="card-body">
                        <div class="requiredfield">
                            <h4>The field labels marked with * are required input fields.</h4>
                        </div>
                        <div class="form-group">
                            <label>Product Barcode</label>
                            <div class="input-groupicon">
                                <input type="text" placeholder="Please type product code and select..." name="barcode" id="barcode">
                                
                            </div>
                        </div>
                       
                            <div class="col-lg-12">
                                <button type="submit">Submit</a>
                                
                            </div>
                        
                    </div>
                </div>
              </form>
              <div>
              <a href="{{ url('photos/barcode.jpg') }}">Download</a>
              </div>

            </div>
        </div>




        </x-admin-layout>
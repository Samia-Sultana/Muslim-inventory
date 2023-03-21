@php
use Illuminate\Support\Facades\Request;
@endphp

<x-admin-layout>
<div class="page-wrapper">
            <div class="content">
                <div class="page-header">
                    <div class="page-title">
                        <h4>User Management</h4>
                        <h6>Add/Update Role</h6>
                    </div>
                </div>

                @php
            $currentUrl = Request::url();
            @endphp
            @if(strpos($currentUrl, 'diamond') !== false)
            <form action="{{route('addRoleDiamond')}}" method="POST">
            @elseif(strpos($currentUrl, 'diamond') == false)
            <form action="{{route('addRole')}}" method="POST">
            @endif                    
            @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Role</label>
                                    <input type="text" name="name" id="name">
                                </div>
                            </div>
                           
                            <div class="col-lg-12">
                                <button type="submit">Submit</a>
                                
                            </div>
                        </div>
                    </div>
                </div>
                </form>

            </div>
        </div>

</x-admin-layout>
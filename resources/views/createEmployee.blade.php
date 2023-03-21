@php
use Illuminate\Support\Facades\Request;
@endphp


<x-admin-layout>
<div class="page-wrapper">
            <div class="content">
                <div class="page-header">
                    <div class="page-title">
                        <h4>User Management</h4>
                        <h6>Add/Update User</h6>
                    </div>
                </div>

                @php
            $currentUrl = Request::url();
            @endphp
            @if(strpos($currentUrl, 'diamond') !== false)
            <form action="{{route('addEmployeeDiamond')}}" method="POST">
            @elseif(strpos($currentUrl, 'diamond') == false)
            <form action="{{route('addEmployee')}}" method="POST">
            @endif
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" name="name" id="name">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="email" id="email">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" name="phone" id="phone">
                                </div>
                            </div>
                          
                          
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Password</label>
                                    <div class="pass-group">
                                        <input type="password" class=" pass-input" name="password" id="password">
                                        <span class="fas toggle-password fa-eye-slash"></span>
                                    </div>
                                </div>
                            </div>
                           
                            
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Role</label>
                                    <select class="select" name="role" id="role">
                                        @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>
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
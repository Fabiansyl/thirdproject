@extends('layouts.admins')

@section('content')
   <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
                <div class="container mt-5">
                    @if (\Session::has('success'))
                          <div class="alert alert-success">
                                <ul>
                                    <p>{!! \Session::get('success') !!}</p>
                                </ul>
                            </div>
                        @elseif (session('error'))
                            <div class="alert alert-danger">
                                <ul>
                                    <p>{{ session('error') }}</p>
                                </ul>
                            </div>                
                    @endif
                </div>
              <h5 class="card-title mb-4 d-inline">ADMINS</h5>
             <a  href="{{route('admins.create')}}" class="btn btn-primary mb-4 text-center float-right">Create Admins</a>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">S/N</th>
                    <th scope="col">USERNAME</th>
                    <th scope="col">EMAIL</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($allAdmins as $admin )
                    <tr>
                    <th scope="row">{{$admin->id}}</th>
                    <td>{{$admin->name}}</td>
                    <td>{{$admin->email}}</td>
                   
                  </tr>
                @endforeach
                  
                </tbody>
              </table> 
            </div>
          </div>
        </div>
      </div>
    
@endsection
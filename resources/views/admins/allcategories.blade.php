@extends('layouts.admins')

@section('content')
<div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <div class="container">
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
               <div class="container">
                      @if (\Session::has('update'))
                          <div class="alert alert-success">
                              <ul>
                                  <p>{!! \Session::get('update') !!}</p>
                              </ul>
                          </div>
                      @endif

                      @if ($errors->any())
                          <div class="alert alert-danger">
                              <ul>
                                  @foreach ($errors->all() as $error)
                                      <li>{{ $error }}</li>
                                  @endforeach
                              </ul>
                          </div>
                      @endif
              </div>
              <div class="container">
                      @if (\Session::has('delete'))
                          <div class="alert alert-success">
                              <ul>
                                  <p>{!! \Session::get('delete') !!}</p>
                              </ul>
                          </div>
                      @endif

                      @if ($errors->any())
                          <div class="alert alert-danger">
                              <ul>
                                  @foreach ($errors->all() as $error)
                                      <li>{{ $error }}</li>
                                  @endforeach
                              </ul>
                          </div>
                      @endif
              </div>
              <h5 class="card-title mb-4 d-inline">Categories</h5>
             <a  href="{{route('categories.create')}}" class="btn btn-primary mb-4 text-center float-right">Create Categories</a>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">S/N</th>
                    <th scope="col">NAME</th>
                    <th scope="col">UPDATE</th>
                    <th scope="col">DELETE</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($allCategories as $category )
                    <tr>
                    <th scope="row">{{$category->id}}</th>
                    <td>{{$category->name}}</td>
                    <td><a  href="{{route('categories.single',['id' => $category->id])}}" class="btn btn-warning text-white text-center ">Update </a></td>
                    <td>
                        <form action="{{ route('categories.delete', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?');">
                          @csrf
                            @method('POST')
                              <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                  </tr> 
                @endforeach
                  
                </tbody>
              </table> 
            </div>
          </div>
        </div>
      </div>
    
@endsection
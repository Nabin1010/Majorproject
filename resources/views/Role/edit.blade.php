@extends('layouts.admin')
@section('admin')

<div class="col-md-12">
    <div class="row justify-content-center"><h1>edit the post</h1></div> 
        {{-- <div class="row justify-content-center align-items-center">     --}}
    <form method="post" action="{{ route('roles.update',$roles->id)}}">
        {{csrf_field()}}
        {{method_field('PUT')}}
        <div class="form-group">
        <label for="Role">Role</label>
        <input type="text" class="form-control" id="title" placeholder="Enter Title" name="title" value="{{ $roles->title}}">
        <span class="text-danger">{{ $errors->first('title')}}</span>
        <button type = "submit" class = "btn btn-primary">Submit</button>
    </div>
    </form>   
    {{-- </div>   --}}
</div>
@endsection
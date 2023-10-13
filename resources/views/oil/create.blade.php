@extends('layouts.app')
  
@section('title', 'Create Product')
  
@section('contents')
    <h1 class="mb-0">Add Oil</h1>
    <hr />
    <form action="{{ route('oil.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <div class="col">
                <input type="text" name="manufacture" class="form-control" placeholder="Manufacture">
            </div>
            <div class="col">
                <input type="text" name="component" class="form-control" placeholder="Component">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <input type="text" name="model" class="form-control" placeholder="Model">
            </div>
            <div class="col">
                <input class="form-control" name="application" placeholder="Application">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <textarea class="form-control" name="deskripsi" placeholder="Description"></textarea>
            </div>
        </div>
 
        <div class="row">
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection
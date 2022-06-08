@extends('layouts.app')
 
@section('content')
    <div class="col-6">             
        <div class="container">
            <div class="row">                                
            @foreach ($categories->data as $category)
                <div class="col d-grid p-1">
                    <a href="{{route('lead.category', $category->id)}}" class="btn btn-primary fs-6" role="button">{{$category->name}}</a>                                
                </div>               
            @if (fmod($loop->iteration,3) == 0)
            </div>
            <div class="row">
            @endif
            @if($loop->last)
            </div>
            @endif
            @endforeach  
        </div>                          
    </div>  
@endsection

  




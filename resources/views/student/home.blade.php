@extends('student.layouts.app')

@section("content")

  @if ($errors->any())
  <ul>
      @foreach ($errors->all() as $error)
          <div class="alert alert-danger" role="alert">
              {{$error}}
          </div>
      @endforeach
  </ul>
  @endif

  @if (session('fail'))
  <div class="alert alert-danger" role="alert">
      {{ session('fail') }}
  </div>
  @endif
  @if (session('success'))
  <div class="alert alert-success" role="alert">
      {{ session('success') }}
  </div>
  @endif

  <h1>{{__("Bienvenue ".Auth::user()->name)}}</h1>   

  <h3>{{__("Vous êtes un étudiant...")}}</h3> 
@endsection
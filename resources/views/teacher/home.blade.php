@extends('teacher.layouts.app')

@section("content")
  <h1>{{__("Bienvenue ".Auth::user()->name)}}</h1>   

  <h3>{{__("Vous êtes un enseignant...")}}</h3> 
@endsection
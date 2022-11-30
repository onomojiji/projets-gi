@extends('teacher.layouts.app')

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
    <div class="alert alert-danger" role="alert">
        {{ session('success') }}
    </div>
    @endif

    <div class="row">
        <div class="col-md-8 mb-3 mb-lg-0">
            <div class="dropdown">
                <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                  + Ajouter un nouveau cours
                </button>
                <form method="post" action="{{route("teacher.classes.store")}}" class="dropdown-menu p-4">
                  @csrf
                    <div class="mb-3">
                    <label for="name" class="form-label">Nom du cours</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="{{__("Ex: Audit des SI")}}">
                  </div>
                  <div class="mb-3">
                    <label for="teacher_id" class="form-label">{{("Enseignant")}}</label>
                    <select class="form-select" aria-label=".form-select-lg example" id="teacher_id" name="teacher_id" required>
                        <option selected value="{{ $teacher['teacher']->id }}">{{ $teacher['user']->name }}</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="year_id" class="form-label">{{("Année academique")}}</label>
                    <select class="form-select" aria-label=".form-select-lg example" id="year_id" name="year_id" required>
                        @foreach ($years as $year)
                            <option value="{{ $year->id }}">{{ $year->value }}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="row">
                    <button type="submit" class="btn btn-primary w-75 mx-auto">{{__("Enregistrer")}}</button>
                  </div>
                  
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <select class="form-select" aria-label=".form-select-lg example" id="year" name="year" required>
                <option selected>{{__("Toutes les annees")}}</option>
                @foreach ($years as $year)
                    <option value="{{ $year->id }}">{{ $year->value }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <hr> 

    <div class="row">
        @if (count($classes) > 0)
            @foreach ($classes as $classe)
                <div class="col">
                    <div class="card mb-5" style="width: 25rem;">
                        <img src="{{asset("images/classe2.jpg")}}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $classe['classe']->name }}</h5>
                            <div class="row">
                                    <p class="card-text text-secondary">
                                        {{ $classe['year'] }} <br class="mb-2">
                                        @if ($classe['count'] == 0)
                                            {{ 'Aucun élève' }}
                                        @elseif ($classe['count'] == 1)
                                            {{ $classe['count']. ' élève' }}
                                        @else
                                            {{ $classe['count']. ' élèves' }}
                                        @endif
                                    </p>
                            </div>
                            
                        </div>
                        <div class="card-footer">
                            <a href="{{route("teacher.classes.show", ['id'=> $classe["classe"]->id])}}" class="btn btn-primary w-100">{{__("Voir le cours")}}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p class="h4 text-secondary text-center">{{__("Vous n'avez aucun cours pour l'instant...")}}</p>
        @endif
        
    </div>
    

@endsection
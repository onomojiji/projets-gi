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
    <div class="alert alert-danger" role="alert">
        {{ session('success') }}
    </div>
    @endif

{{------------------------------ All my classes -----------------------------}}

    <div class="row">
        <div class="col-md-8 mb-3 mb-lg-0">
          <h3>{{__("Mes cours")}}</h3>
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

    <div class="row justify-content-start">
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
                                    </p>
                            </div>
                            
                        </div>
                        <div class="card-footer">
                            <a href="{{route("student.classes.show", ['id'=> $classe["classe"]->id])}}" class="btn btn-primary w-100">{{__("Voir le cours")}}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p class="h4 text-secondary text-center">{{__("Vous n'êtes inscrit à aucun cours pour l'instant...")}}</p>
        @endif
        
    </div>

{{----------------------------- All my groups ---------------------------------------}}
    <div id="mygroups" class="row">
        <div class="col-md-8 mb-3 mb-lg-0">
          <h3>{{__("Mes groupes")}}</h3>
        </div>
        <div class="col-md-4">
            <select class="form-select" aria-label=".form-select-lg example" id="year" name="year" required>
                <option value="">{{__("Ordre alphabetique")}}</option>
            </select>
        </div>
    </div>

    <hr> 

    <div class="row justify-content-start">

        @if (count($myGroups) > 0)
            @foreach ($myGroups as $mg)
                <div class="col">
                    <div class="card mb-5" style="width: 18rem;">
                        <img src="{{asset("images/folder.png")}}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <div class="row">
                                <h5 class="card-title">{{ $mg['group']->title }}</h5>
                            </div>
                            <div class="row">
                                    <p style="display: -webkit-box;
                                    -webkit-line-clamp: 2;
                                    -webkit-box-orient: vertical;
                                    overflow: hidden;
                                    text-overflow: ellipsis;" class="card-text text-secondary">
                                        {{ $mg['classe']->name }} <br class="mb-2">
                                    </p>
                            </div>
                            <div class="row">
                                <p class="card-text">{{ $mg['year'] }}</p>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{route("student.groups.show", ['id' => $mg['group']->id, 'classe_id' => $mg['classe']->id])}}" class="btn btn-primary w-100">{{__("Voir le groupe")}}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p class="h4 text-secondary text-center">{{__("Aucun projet inscrit pour l'instant...")}}</p>
        @endif

    </div>

    <div id="projects" class="row">
        <div class="col-md-8 mb-3 mb-lg-0">
          <h3>{{__("Tous les projets")}}</h3>
        </div>
        <div class="col-md-4">
            <select class="form-select" aria-label=".form-select-lg example" id="year" name="year" required>
                <option value="">{{__("Ordre alphabetique")}}</option>
                <option value="">{{__("Date d'ajout")}}</option>
                <option value="">{{__("Plus de likes")}}</option>
                <option value="">{{__("Plus grande note")}}</option>
            </select>
        </div>
    </div>

    <hr> 

    <div class="row align-item-start">

        @if (count($projects) > 0)
            @foreach ($projects as $project)
                <div class="col">
                    <div class="card mb-5" style="width: 18rem;">
                        <img src="{{asset("images/file-zip.png")}}" height="200" class="card-img-top" alt="...">
                        <div class="card-body">
                                <h5 class="card-title text-info">{{ $project['note'] }}</h5>
                                    <p style="display: -webkit-box;
                                    -webkit-line-clamp: 3;
                                    -webkit-box-orient: vertical;
                                    overflow: hidden;
                                    text-overflow: ellipsis;" class="card-text text-secondary">
                                        {{ $project['project']->theme }} <br class="mb-2">
                                    </p>
                            
                        </div>
                        <div class="card-footer">
                            <a href="{{route("student.groups.show", ['id' => $project['project']->id, 'classe_id' => $project['classe']])}}" class="btn btn-primary w-100">{{__("Voir le projet")}}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p class="h4 text-secondary text-center">{{__("Aucun projet inscrit pour l'instant...")}}</p>
        @endif

    </div>
    
@endsection
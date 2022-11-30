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

    <div class="row">
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

    <div class="row">

        <div class="col">
            <div class="card mb-5" style="width: 18rem;">
                <img src="{{asset("images/file-zip.png")}}" height="200" class="card-img-top" alt="...">
                <div class="card-body">
                        <h5 class="card-title">{{ "18/20 (Très bien)" }}</h5>
                            <p style="display: -webkit-box;
                            -webkit-line-clamp: 3;
                            -webkit-box-orient: vertical;
                            overflow: hidden;
                            text-overflow: ellipsis;" class="card-text text-secondary">
                                {{ "CONCEPTION D'UN SITE WEB DE GÉOLOCALISATION DES ÉTUDIANTS DE L' ÉCOLE NATIONALE SUPÉRIEURE POLYTECHNIQUE DE DOUALA" }} <br class="mb-2">
                            </p>
                    
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-primary w-100">{{__("Voir le projet")}}</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card mb-5" style="width: 18rem;">
                <img src="{{asset("images/file-zip.png")}}" height="200" class="card-img-top" alt="...">
                <div class="card-body">
                        <h5 class="card-title">{{ "18/20 (Très bien)" }}</h5>
                            <p style="display: -webkit-box;
                            -webkit-line-clamp: 3;
                            -webkit-box-orient: vertical;
                            overflow: hidden;
                            text-overflow: ellipsis;" class="card-text text-secondary">
                                {{ "CONCEPTION D'UN SITE WEB DE GÉOLOCALISATION DES ÉTUDIANTS DE L' ÉCOLE NATIONALE SUPÉRIEURE POLYTECHNIQUE DE DOUALA" }} <br class="mb-2">
                            </p>
                    
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-primary w-100">{{__("Voir le projet")}}</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card mb-5" style="width: 18rem;">
                <img src="{{asset("images/file-zip.png")}}" height="200" class="card-img-top" alt="...">
                <div class="card-body">
                        <h5 class="card-title">{{ "18/20 (Très bien)" }}</h5>
                            <p style="display: -webkit-box;
                            -webkit-line-clamp: 3;
                            -webkit-box-orient: vertical;
                            overflow: hidden;
                            text-overflow: ellipsis;" class="card-text text-secondary">
                                {{ "CONCEPTION D'UN SITE WEB DE GÉOLOCALISATION DES ÉTUDIANTS DE L' ÉCOLE NATIONALE SUPÉRIEURE POLYTECHNIQUE DE DOUALA" }} <br class="mb-2">
                            </p>
                    
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-primary w-100">{{__("Voir le projet")}}</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card mb-5" style="width: 18rem;">
                <img src="{{asset("images/file-zip.png")}}" height="200" class="card-img-top" alt="...">
                <div class="card-body">
                        <h5 class="card-title">{{ "18/20 (Très bien)" }}</h5>
                            <p style="display: -webkit-box;
                            -webkit-line-clamp: 3;
                            -webkit-box-orient: vertical;
                            overflow: hidden;
                            text-overflow: ellipsis;" class="card-text text-secondary">
                                {{ "CONCEPTION D'UN SITE WEB DE GÉOLOCALISATION DES ÉTUDIANTS DE L' ÉCOLE NATIONALE SUPÉRIEURE POLYTECHNIQUE DE DOUALA" }} <br class="mb-2">
                            </p>
                    
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-primary w-100">{{__("Voir le projet")}}</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card mb-5" style="width: 18rem;">
                <img src="{{asset("images/file-zip.png")}}" height="200" class="card-img-top" alt="...">
                <div class="card-body">
                        <h5 class="card-title">{{ "18/20 (Très bien)" }}</h5>
                            <p style="display: -webkit-box;
                            -webkit-line-clamp: 3;
                            -webkit-box-orient: vertical;
                            overflow: hidden;
                            text-overflow: ellipsis;" class="card-text text-secondary">
                                {{ "CONCEPTION D'UN SITE WEB DE GÉOLOCALISATION DES ÉTUDIANTS DE L' ÉCOLE NATIONALE SUPÉRIEURE POLYTECHNIQUE DE DOUALA" }} <br class="mb-2">
                            </p>
                    
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-primary w-100">{{__("Voir le projet")}}</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card mb-5" style="width: 18rem;">
                <img src="{{asset("images/file-zip.png")}}" height="200" class="card-img-top" alt="...">
                <div class="card-body">
                        <h5 class="card-title">{{ "18/20 (Très bien)" }}</h5>
                            <p style="display: -webkit-box;
                            -webkit-line-clamp: 3;
                            -webkit-box-orient: vertical;
                            overflow: hidden;
                            text-overflow: ellipsis;" class="card-text text-secondary">
                                {{ "CONCEPTION D'UN SITE WEB DE GÉOLOCALISATION DES ÉTUDIANTS DE L' ÉCOLE NATIONALE SUPÉRIEURE POLYTECHNIQUE DE DOUALA" }} <br class="mb-2">
                            </p>
                    
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-primary w-100">{{__("Voir le projet")}}</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card mb-5" style="width: 18rem;">
                <img src="{{asset("images/file-zip.png")}}" height="200" class="card-img-top" alt="...">
                <div class="card-body">
                        <h5 class="card-title">{{ "18/20 (Très bien)" }}</h5>
                            <p style="display: -webkit-box;
                            -webkit-line-clamp: 3;
                            -webkit-box-orient: vertical;
                            overflow: hidden;
                            text-overflow: ellipsis;" class="card-text text-secondary">
                                {{ "CONCEPTION D'UN SITE WEB DE GÉOLOCALISATION DES ÉTUDIANTS DE L' ÉCOLE NATIONALE SUPÉRIEURE POLYTECHNIQUE DE DOUALA" }} <br class="mb-2">
                            </p>
                    
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-primary w-100">{{__("Voir le projet")}}</a>
                </div>
            </div>
        </div>

    </div>
    
@endsection
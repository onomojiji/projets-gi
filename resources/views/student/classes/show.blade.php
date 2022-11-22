@extends('student.layouts.app')

@section("content")
    <div class="mb-3 py-5" style="border-radius : 10px;background-image: url({{asset('images/classe2.jpg')}}); background-size: cover;">
        <p class="h1 text-center mx-1">{{ $classe->name }}</p>  
        <p class="h5 text-center mx-1">{{ "Par : ".$teacher }}</p>  
    </div>

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

    <div class="row">
        <div class="col-md-8"></div>
        <div class="col-md-4 text-end">
            <div class="dropdown">
                <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                + Creer mon groupe de TP
                </button>
                <form method="post" action="#" class="dropdown-menu p-4">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Groupe N°</label>
                        <input type="number" class="form-control" id="name" name="name" placeholder="{{__("Ex: 1")}}">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Theme</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="{{__("Ex: Conception d'un ERP")}}">
                    </div>
                    <div class="row">
                        <button type="submit" class="btn btn-primary w-75 mx-auto">{{__("Enregistrer")}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <hr>
    
    <div class="row">
        <div class="col">
            <div class="card mb-5" style="width: 18rem;">
                <img src="{{asset("images/folder.png")}}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ "GROUPE 01" }}</h5>
                    <div class="row">
                            <p class="card-text text-secondary">
                                {{ 'Bibliotheque des projets GI et implementation de quoiquoiquoi' }} <br class="mb-2">
                            </p>
                    </div>
                    
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-primary w-100">{{__("Voir le projet")}}</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card mb-5" style="width: 18rem;">
                <img src="{{asset("images/folder.png")}}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ "GROUPE 01" }}</h5>
                    <div class="row">
                            <p class="card-text text-secondary">
                                {{ 'Bibliotheque des projets GI et implementation de quoiquoiquoi' }} <br class="mb-2">
                            </p>
                    </div>
                    
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-primary w-100">{{__("Voir le projet")}}</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card mb-5" style="width: 18rem;">
                <img src="{{asset("images/folder.png")}}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ "GROUPE 01" }}</h5>
                    <div class="row">
                            <p class="card-text text-secondary">
                                {{ 'Bibliotheque des projets GI et implementation de quoiquoiquoi' }} <br class="mb-2">
                            </p>
                    </div>
                    
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-primary w-100">{{__("Voir le projet")}}</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card mb-5" style="width: 18rem;">
                <img src="{{asset("images/folder.png")}}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ "GROUPE 01" }}</h5>
                    <div class="row">
                            <p class="card-text text-secondary">
                                {{ 'Bibliotheque des projets GI et implementation de quoiquoiquoi' }} <br class="mb-2">
                            </p>
                    </div>
                    
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-primary w-100">{{__("Voir le projet")}}</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card mb-5" style="width: 18rem;">
                <img src="{{asset("images/folder.png")}}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ "GROUPE 01" }}</h5>
                    <div class="row">
                            <p class="card-text text-secondary">
                                {{ 'Bibliotheque des projets GI et implementation de quoiquoiquoi' }} <br class="mb-2">
                            </p>
                    </div>
                    
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-primary w-100">{{__("Voir le projet")}}</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card mb-5" style="width: 18rem;">
                <img src="{{asset("images/folder.png")}}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ "GROUPE 01" }}</h5>
                    <div class="row">
                            <p class="card-text text-secondary">
                                {{ 'Bibliotheque des projets GI et implementation de quoiquoiquoi' }} <br class="mb-2">
                            </p>
                    </div>
                    
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-primary w-100">{{__("Voir le projet")}}</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card mb-5" style="width: 18rem;">
                <img src="{{asset("images/folder.png")}}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ "GROUPE 01" }}</h5>
                    <div class="row">
                            <p class="card-text text-secondary">
                                {{ 'Bibliotheque des projets GI et implementation de quoiquoiquoi' }} <br class="mb-2">
                            </p>
                    </div>
                    
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-primary w-100">{{__("Voir le projet")}}</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card mb-5" style="width: 18rem;">
                <img src="{{asset("images/folder.png")}}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ "GROUPE 01" }}</h5>
                    <div class="row">
                            <p class="card-text text-secondary">
                                {{ 'Bibliotheque des projets GI et implementation de quoiquoiquoi' }} <br class="mb-2">
                            </p>
                    </div>
                    
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-primary w-100">{{__("Voir le projet")}}</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card mb-5" style="width: 18rem;">
                <img src="{{asset("images/folder.png")}}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ "GROUPE 01" }}</h5>
                    <div class="row">
                            <p class="card-text text-secondary">
                                {{ 'Bibliotheque des projets GI et implementation de quoiquoiquoi' }} <br class="mb-2">
                            </p>
                    </div>
                    
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-primary w-100">{{__("Voir le projet")}}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
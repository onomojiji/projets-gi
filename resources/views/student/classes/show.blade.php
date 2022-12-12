@extends('student.layouts.app')

@section("content")
    <div class="mb-3 pt-2 pb-5" style="border-radius : 10px;background-image: url({{asset('images/classe2.jpg')}}); background-size: cover;">
        <p class="h5 text-primary text-center mx-1">{{ $classe->year->value }}</p>  
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

    @if (!$isInGroup)
        
        <div class="row">
            <div class="col-md-8"></div>
            <div class="col-md-4 text-end">
                <div class="dropdown">
                    <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                    + Creer mon groupe de TP
                    </button>
                    <form method="post" action="{{route("student.groups.store", ["id" => $classe->id])}}" class="dropdown-menu p-4">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Groupe N°</label>
                            <input type="number" class="form-control" id="title" name="title" min="0" placeholder="{{__("Ex: 1")}}" required>
                        </div>
                        <div class="mb-3">
                            <label for="theme" class="form-label">Theme</label>
                            <input type="text" class="form-control" id="theme" name="theme" placeholder="{{__("Ex: Conception d'un ERP")}}" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea style="resize: none" class="form-control" name="description" id="description" name="description" placeholder="Ex: Il est questiion pour nous de mettre en place un ERP" cols="30" rows="3"></textarea>
                        </div>
                        <div class="row">
                            <button type="submit" class="btn btn-primary w-75 mx-auto">{{__("Enregistrer")}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <hr>
    @endif
     
    <div class="row">
        @if (count($groups) > 0)
            @foreach ($groups as $group)
                <div class="col">
                    <div class="card mb-5" style="width: 18rem;">
                        <img src="{{asset("images/folder.png")}}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="card-title">{{ $group->title }}</h5>
                                </div>
                                @if ($group == $myGroup)
                                    <div class="col-md-6 text-end">
                                        <span class="bg-info text-light rounded p-1">{{__("Mon groupe")}}</span>
                                    </div>
                                @endif
                                
                            </div>
                            <div class="row">
                                    <p style="display: -webkit-box;
                                    -webkit-line-clamp: 2;
                                    -webkit-box-orient: vertical;
                                    overflow: hidden;
                                    text-overflow: ellipsis;" class="card-text text-secondary">
                                        {{ $group->theme }} <br class="mb-2">
                                    </p>
                            </div>
                            
                        </div>
                        <div class="card-footer">
                            <a href="{{route("student.groups.show", ['id' => $group->id, 'classe_id' => $classe->id])}}" class="btn btn-primary w-100">{{__("Voir le groupe")}}</a>
                        </div>
                    </div>
                </div>
            @endforeach
            
        @else
            <p class="h4 text-secondary text-center my-3">{{ __("Cette classe n'a actuellement aucun groupe de TP...") }}</p>
        @endif
        
    </div>
@endsection
@extends('student.layouts.app')

@section("content")

    <div class="mb-2 py-2 shadow-sm" style="border-radius : 10px; background-color: rgb(224, 224, 213)">
        <p class="h1 text-center mx-1">{{ $group->theme }}</p>  
        <p class="h5 text-center mx-1">{{ $group->title }}</p>  

        @if ($isDelegate)
            <div class="row">
                <div class="col-md-8 text-start">
                    @if ($group->token == null)
                        <a href="{{route("student.groups.generate.link", ['id'=>$group->id])}}" class="m-1 btn btn-info">{{__("Generer le lien d'inscriprion")}}</a>
                    @else
                        <div class="input-group m-1">
                            <input type="text" class="form-control" value="{{ "http://localhost:8000/student/classes/".$classe->id."/groups/join/inimini/".$group->token }}" disabled aria-label="Recipient's username" aria-describedby="button-addon2">
                            <a class="btn btn-primary" href="{{route("student.groups.generate.link", ['id'=>$group->id, 'classe_id' => $classe->id])}}" id="button-addon2">{{__("Generer un nouveau lien")}}</a>
                        </div>
                            
                    @endif
                </div>

                <div class="col-md-4 text-end">
                    <div class="dropdown m-1">
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                            Modifier le groupe
                        </button>
                        <form method="post" action="{{route("student.groups.update.theme", ['id' => $group->id, 'classe_id' => $classe->id])}}" class="dropdown-menu p-4">
                            @csrf
                            <div class="mb-3">
                                <label for="theme" class="form-label">{{__("Theme du group")}}</label>
                                <input type="text" class="form-control" id="theme" name="theme" value="{{ $group->theme }}">
                            </div>
                            <div class="row">
                                <button type="submit" class="btn btn-primary w-75 mx-auto">{{__("Enregistrer")}}</button>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
        @endif
        
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

            @if ($isDelegate)
                <div class="dropdown">
                    <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                        + Ajouter un fichier
                    </button>
                    <form method="post" action="" class="dropdown-menu p-4">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">{{__("Nom du fichier")}}</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="{{__("Ex: Cahier de charges")}}" required>
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">{{__("Fichier")}}</label>
                            <input type="file" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="row">
                            <button type="submit" class="btn btn-primary w-75 mx-auto">{{__("Enregistrer")}}</button>
                        </div>
                    </form>
                </div>
            @endif
            
            
        </div>
    </div>

    <hr>

@endsection
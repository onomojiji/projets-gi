@extends('teacher.layouts.app')

@section("content")
    <div class="mb-3" style="padding-top: 5rem; border-radius : 10px;background-image: url({{asset('images/classe2.jpg')}}); background-size: cover;">
        
        <p class="h1 text-center mx-1" style="margin-bottom: 3rem">{{ $classe->name }}</p>
        
        <div class="row">
            <div class="col-md-8 text-start">
                @if ($classe->token == null)
                    <a href="{{route("teacher.classes.generate.link", ['id'=>$classe->id])}}" class="m-1 btn btn-info">{{__("Generer le lien d'inscriprion")}}</a>
                @else
                    <div class="input-group m-1">
                        <input type="text" class="form-control" value="{{ "http://localhost:8000/student/classes/join/inimini/".$classe->token }}" disabled aria-label="Recipient's username" aria-describedby="button-addon2">
                        <a class="btn btn-primary" href="{{route("teacher.classes.generate.link", ['id'=>$classe->id])}}" id="button-addon2">{{__("Generer un nouveau lien")}}</a>
                    </div>
                        
                @endif
            </div>

            <div class="col-md-4 text-end">
                <div class="dropdown m-1">
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                        Modifier le cours
                    </button>
                    <form method="post" action="{{route("teacher.classes.update.name", ['id' => $classe->id])}}" class="dropdown-menu p-4">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">{{__("Nom du cours")}}</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $classe->name }}">
                        </div>
                        <div class="row">
                            <button type="submit" class="btn btn-primary w-75 mx-auto">{{__("Enregistrer")}}</button>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
        
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

    <hr>
    <div class="mt-2">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">{{__("Etudiants")}}</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="disabled-tab" data-bs-toggle="tab" data-bs-target="#disabled-tab-pane" type="button" role="tab" aria-controls="disabled-tab-pane" aria-selected="false" >{{__("Groupes de TP")}}</button>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">

            {{-- Student tab --}}
            <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                @if (count($classStudent) > 0)
                    <table class="table table-hover mt-2">
                        <thead class="table-primary">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{__("Matricule")}}</th>
                            <th scope="col">{{__("Nom(s) et prenom(s)")}}</th>
                            <th scope="col">{{__("Groupe")}}</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($classStudent as $cs)
                                <tr>
                                    <th scope="row">1</th>
                                    <td>{{ $cs['user']->matricule }}</td>
                                    <td>{{ $cs['user']->name }}</td>
                                    <td>Groupe</td>
                                </tr>
                            @endforeach
                        
                        </tbody>
                    </table>
                @else
                    <p class="my-3 h4 text-secondary text-center">{{__("Aucun eleve inscrit a ce cours..")}}</p>
                @endif
                
            </div>

            {{-- Groupe tab --}}
            <div class="tab-pane fade" id="disabled-tab-pane" role="tabpanel" aria-labelledby="disabled-tab" tabindex="0">...</div>
          </div>          
    </div>
@endsection
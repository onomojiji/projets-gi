@extends('teacher.layouts.app')

@section("content")
    <div class="mb-3" style="padding-top: 1rem; border-radius : 10px;background-image: url({{asset('images/classe2.jpg')}}); background-size: cover;">
        <p class="h5 text-primary text-center mx-1">{{ $classe->year->value }}</p>  
        <p class="h1 text-center mx-1" style="margin-bottom: 2rem">{{ $classe->name }}</p>
        
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

    <div class="accordion" id="accordionExample">

        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    {{__("Listes des groupes de TP")}}
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    @if (count($groups) > 0)
                        <table class="table table-hover mt-2">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">{{__("Groupe")}}</th>
                                    <th scope="col">{{__("Theme")}}</th>
                                    <th scope="col">{{__("Membres")}}</th>
                                    <th scope="col">{{__("Note")}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = 1; $i <= count($groups); $i++)
                                @if ($groups[$i-1]['group'] != null)
                                    <tr>
                                        <th scope="row">{{ $i }}</th>
                                        <td>{{ $groups[$i-1]['group']->title }}</td>
                                        <td>
                                            <a class="text-decoration-none" href="{{route("teacher.groups.show", ['classe_id'=> $classe->id, 'id' => $groups[$i-1]['group']->id])}}">
                                                {{ $groups[$i-1]['group']->theme }}
                                            </a>
                                        </td>
                                        <td>{{ $groups[$i-1]['students'] }}</td>
                                        @if ($groups[$i-1]['note'] != null)
                                            <td class="text-primary">{{ $groups[$i-1]['note']->value."/20" }}</td>
                                        @else
                                            <td class="text-secondary">{{ __("Non noté") }}</td>
                                        @endif
                                        
                                    </tr>
                                @endif
                                    
                                @endfor
                            </tbody>
                        </table>
                    @else
                        <p class="my-3 h4 text-secondary text-center">{{__("Aucun groupe de TP...")}}</p>
                    @endif
                </div>
            </div>
        </div>

        <hr>

        <div class="accordion-item">
          <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              {{__("Liste des eleves")}}
            </button>
          </h2>
          <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                @if (count($classStudent) > 0)
                    <table class="table table-hover mt-2">
                        <thead class="table-primary">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{__("Matricule")}}</th>
                            <th scope="col">{{__("Nom(s) et prenom(s)")}}</th>
                            <th scope="col">{{__("Sexe")}}</th>
                            <th scope="col">{{__("Groupe")}}</th>
                        </tr>
                        </thead>
                        <tbody>
                            @for ($i = 1; $i <= count($classStudent); $i++)
                                <tr>
                                    <th scope="row">{{ $i }}</th>
                                    <td>{{ $classStudent[$i-1]['user']->matricule }}</td>
                                    <td>{{ $classStudent[$i-1]['user']->name }}</td>
                                    <td>{{ $classStudent[$i-1]['user']->sex }}</td>
                                    <td>
                                        @if ($classStudent[$i-1]['group'] != null)
                                            <a class="text-decoration-none" href="{{route("teacher.groups.show", ['classe_id'=> $classe->id, 'id' => $classStudent[$i-1]['group']->id])}}">
                                                {{ $classStudent[$i-1]['group']->title }}
                                            </a>  
                                        @else
                                            {{__("N'a pas de groupe")}}
                                        @endif
                                        
                                    </td>
                                </tr>
                            @endfor
                        
                        </tbody>
                    </table>
                @else
                    <p class="my-3 h4 text-secondary text-center">{{__("Aucun eleve inscrit a ce cours..")}}</p>
                @endif
            </div>
          </div>
        </div>
        
      </div>

@endsection
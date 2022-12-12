@extends('teacher.layouts.app')

@section("content")

    <div class="mb-2 py-2 shadow-sm" style="border-radius : 10px; background-color: rgb(224, 224, 213)">
        
        <p class="h5 text-center mx-1">
            <a class="text-decoration-none" href="{{route("teacher.classes.show", ['id'=> $classe->id])}}">
                {{ $classe->name }}
            </a>
        </p>  
        <p class="h1 text-center mx-1">{{ $group->theme }}</p>  
        <p class="h5 text-center mx-1">{{ $group->title }}</p>  
        
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
        <div class="col">
            <div class="row mt-2">
                @if ($note != null)
                    <div class="col">
                        {{__("Note : ")}} <span class="text-success">{{ $note->value."/20" }}</span> 
                    </div>
                @else
                    <div class="col d-flex">
                        <div class="dropdown">
                            <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                              {{__("Attribuer une note à ce groupe")}}
                            </button>
                            <form method="post" action="{{route("teacher.groups.note", ['classe_id' => $classe->id, 'id' => $group->id ])}}" class="dropdown-menu p-4">
                              @csrf
                                <div class="mb-3">
                                    <div class="input-group flex-nowrap">
                                        <input type="number" min="0" max="20" class="form-control" placeholder="Ex: 14" aria-describedby="addon-wrapping" name="note">
                                        <span class="input-group-text" id="addon-wrapping">{{__("Sur 20")}}</span>
                                      </div>
                                </div>
                                <div class="row">
                                    <button type="submit" class="btn btn-primary w-75 mx-auto">{{__("Noter")}}</button>
                                </div>
                              
                            </form>
                        </div>
                    </div>
                @endif
                
                <div class="col">
                    <i class="bi bi-heart-fill text-danger"></i>
                    <span class="text-danger">{{ $likes }}</span>
                </div>
                <div class="col">
                    <i class="bi bi-chat-dots"></i> {{ $comments }}
                </div>
            </div>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-6 mb-3 mb-lg-0">

            <h5>{{_("Liste des membres")}}</h5>

            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>{{__("#")}}</th>
                        <th>{{__("Matricule")}}</th>
                        <th>{{__("Nom(s) et prenom(s)")}}</th>
                        <th>{{__("poste")}}</th>
                    </tr>
                </thead>
                <tbody>

                    @for ($i = 1; $i <= count($groupStudents); $i++)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $groupStudents[$i-1]['student']->student->user->matricule }}</td>
                            <td>{{ $groupStudents[$i-1]['student']->student->user->name }}</td>
                            @if ( $groupStudents[$i-1]['status'] == true)
                                <td class="text-primary">{{ "Chef de groupe" }}</td>
                            @else
                                <td>{{ __("Membre") }}</td>
                            @endif
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
        <div class="col-md-6 mb-3 mb-lg-0">

            @if (count($groupFiles) > 0)
                
            <h5>{{__("Liste des fichiers")}}</h5>

                @foreach ($groupFiles as $gf)

                    <div class="input-group m-1">
                        <input type="text" class="form-control" value="{{ $gf['file']->title }}" disabled aria-label="Recipient's username" aria-describedby="button-addon2">
                        <a class="btn btn-primary" href="{{route("student.download.file", ['id' => $gf['file']->id, 'group_id' => $group->id])}}" id="button-addon2"> <i class="bi bi-arrow-down-circle"></i> {{ $gf['downloads'] }}</a>
                    </div>

                @endforeach
                
            @else
                <p class="h5 text-center text-secondary">{{__("Aucun fichier...")}}</p>
            @endif

            

        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col">

            <h5>{{__("Commentaires")}}</h5>

            <form class="row" action="{{route("student.groups.comment", ['classe_id' => $classe->id, 'id' => $group->id])}}" method="post">
                @csrf
                <div class="col-9 mb-3">
                    <textarea style="resize: none" class="form-control" id="comment" name="comment" placeholder="Laissez votre commentaire ici..." cols="5" rows="2"></textarea>     
                </div>

                <div class="col-3 mb-3">
                    <button id="comment" class="h-100 btn btn-primary form-control" type="submit"> <i class="bi bi-send h3"></i></button>
                </div>
            </form>

        </div>
    </div>

    <div id="comments">

        @if (count($groupComments) > 0)
            @foreach ($groupComments as $groupComment)
                <div class="row mb-3">
                    <div class="col-1">
                        <i class="bi bi-person-circle text-secondary h1"></i>
                    </div>
                    <div class="col-9 border rounded">
                        <p class="text-secondary h5">{{ $groupComment["user"]->name." - " }} 
                            @if ($groupComment["isTeacher"])
                                <span class="badge text-bg-primary">{{__("Enseignant")}}</span></p>
                            @endif
                            
                        <p>{{ $groupComment['comment']->text }}</p>
                    </div>
                    <div class="col-1 my-auto mx-auto text-secondary">
                    <em>{{ $groupComment['comment']->created_at }}</em> 
                    </div>
                </div>
            @endforeach
        @else
            
        @endif

        

    </div>
    

@endsection
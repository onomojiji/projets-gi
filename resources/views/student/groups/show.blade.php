@extends('student.layouts.app')

@section("content")

    <div class="mb-2 py-2 shadow-sm" style="border-radius : 10px; background-color: rgb(224, 224, 213)">
        <p class="h1 text-center mx-1">{{ $group->theme }}</p>  
        <p class="h5 text-center mx-1">{{ $group->title }}</p>  

        @if ($isDelegate)
            <div class="row">
                <div class="col-md-8 text-start">
                    @if ($group->token == null)
                        <a href="{{route("student.groups.generate.link", ['id'=>$group->id, 'classe_id' => $classe->id])}}" class="m-1 btn btn-info">{{__("Generer le lien d'inscriprion")}}</a>
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
                        <form method="post" action="{{route("student.groups.update.theme", ['classe_id' => $classe->id, 'id' => $group->id])}}" class="dropdown-menu p-4">
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
        <div class="col-md-8">
            <div class="row mt-2">
                <div class="col">
                    {{__("Note : ")}} <span class="text-success">{{ "18/20" }}</span> 
                </div>
                <div class="col text-secondary">
                    <i class="bi bi-heart"></i> <i class="bi bi-heart-fill text-danger"></i>  <span class="text-danger">{{__("12 ")}}</span>
                </div>
                <div class="col">
                    <i class="bi bi-chat-dots"></i> {{__("45 ")}}
                </div>
            </div>
        </div>
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

            <h5>{{_("Fichiers du groupe")}}</h5>

            <div class="input-group m-1">
                <input type="text" class="form-control" value="{{ "Analyse et conception ( pdf ) ( 1.2MB )" }}" disabled aria-label="Recipient's username" aria-describedby="button-addon2">
                <a class="btn btn-primary" href="#" id="button-addon2"><i class="bi bi-arrow-down-circle"></i></a>
            </div>

            <div class="input-group m-1">
                <input type="text" class="form-control" value="{{ "Interfaces Adobe XD ( pdf ) ( 10.2MB )" }}" disabled aria-label="Recipient's username" aria-describedby="button-addon2">
                <a class="btn btn-primary"  href="#" id="button-addon2"><i class="bi bi-arrow-down-circle"></i></a>
            </div>

            <div class="input-group m-1">
                <input type="text" class="form-control" value="{{ "Projet React js ( zip ) ( 100.5MB )" }}" disabled aria-label="Recipient's username" aria-describedby="button-addon2">
                <a class="btn btn-primary"  href="#" id="button-addon2"><i class="bi bi-arrow-down-circle"></i></a>
            </div>

        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col">

            <h5>{{__("Commentaires")}}</h5>

            <form class="row" action="" method="post">
                @csrf
                <div class="col-9 mb-3">
                    <textarea style="resize: none" class="form-control" id="comment" name="comment" placeholder="Laissez votre commentaire ici..." cols="5" rows="2"></textarea>     
                </div>

                <div class="col-3 mb-3">
                    <button id="comment" class="h-100 btn btn-primary form-control" type="submit">{{__("Commenter ")}} <i class="bi bi-chat-left-dots"></i></button>
                </div>
            </form>

        </div>
    </div>

    <div id="comments">
        <div class="row mb-3">
            <div class="col-1">
                <i class="bi bi-person-circle text-secondary h1"></i>
            </div>
            <div class="col-9 border rounded">
                <p class="text-secondary h5">{{__("Nom et prenom")}}</p>
                <p>{{ __("Contenu du message. afjksdfhs hgsjhfg kh gjhsgdfhgsdjhfg ksdhjfgs fksdhg ffsjdgfjf gsdfsdjgf sdgjhfgsugfyusdg fyugs yugdfyusgiaufgasf sygfsatsfgsguof syu ysu gayfyusg fygsa uofgsyugo fyosfg ygsfyag yogasf yu..") }}</p>
            </div>
            <div class="col-1 my-auto mx-auto text-secondary">
            <em>{{__("Aujourd'hui à 11h30min")}}</em> 
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col-1">
                <i class="bi bi-person-circle text-secondary h1"></i>
            </div>
            <div class="col-9 border rounded">
                <p class="text-secondary h5">{{__("Nom et prenom")}}</p>
                <p>{{ __("Contenu du message. afjksdfhs hgsjhfg kh gjhsgdfhgsdjhfg ksdhjfgs fksdhg ffsjdgfjf gsdfsdjgf sdgjhfgsugfyusdg fyugs yugdfyusgiaufgasf sygfsatsfgsguof syu ysu gayfyusg fygsa uofgsyugo fyosfg ygsfyag yogasf yu..") }}</p>
            </div>
            <div class="col-1 my-auto mx-auto text-secondary">
            <em>{{__("Aujourd'hui à 11h30min")}}</em> 
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-1">
                <i class="bi bi-person-circle text-secondary h1"></i>
            </div>
            <div class="col-9 border rounded">
                <p class="text-secondary h5">{{__("Nom et prenom")}}</p>
                <p>{{ __("Contenu du message. afjksdfhs hgsjhfg kh gjhsgdfhgsdjhfg ksdhjfgs fksdhg ffsjdgfjf gsdfsdjgf sdgjhfgsugfyusdg fyugs yugdfyusgiaufgasf sygfsatsfgsguof syu ysu gayfyusg fygsa uofgsyugo fyosfg ygsfyag yogasf yu..") }}</p>
            </div>
            <div class="col-1 my-auto mx-auto text-secondary">
            <em>{{__("Aujourd'hui à 11h30min")}}</em> 
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-1">
                <i class="bi bi-person-circle text-secondary h1"></i>
            </div>
            <div class="col-9 border rounded">
                <p class="text-secondary h5">{{__("Nom et prenom")}}</p>
                <p>{{ __("Contenu du message. afjksdfhs hgsjhfg kh gjhsgdfhgsdjhfg ksdhjfgs fksdhg ffsjdgfjf gsdfsdjgf sdgjhfgsugfyusdg fyugs yugdfyusgiaufgasf sygfsatsfgsguof syu ysu gayfyusg fygsa uofgsyugo fyosfg ygsfyag yogasf yu..") }}</p>
            </div>
            <div class="col-1 my-auto mx-auto text-secondary">
            <em>{{__("Aujourd'hui à 11h30min")}}</em> 
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-1">
                <i class="bi bi-person-circle text-secondary h1"></i>
            </div>
            <div class="col-9 border rounded">
                <p class="text-secondary h5">{{__("Nom et prenom")}}</p>
                <p>{{ __("Contenu du message. afjksdfhs hgsjhfg kh gjhsgdfhgsdjhfg ksdhjfgs fksdhg ffsjdgfjf gsdfsdjgf sdgjhfgsugfyusdg fyugs yugdfyusgiaufgasf sygfsatsfgsguof syu ysu gayfyusg fygsa uofgsyugo fyosfg ygsfyag yogasf yu..") }}</p>
            </div>
            <div class="col-1 my-auto mx-auto text-secondary">
            <em>{{__("Aujourd'hui à 11h30min")}}</em> 
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-1">
                <i class="bi bi-person-circle text-secondary h1"></i>
            </div>
            <div class="col-9 border rounded">
                <p class="text-secondary h5">{{__("Nom et prenom")}}</p>
                <p>{{ __("Contenu du message. afjksdfhs hgsjhfg kh gjhsgdfhgsdjhfg ksdhjfgs fksdhg ffsjdgfjf gsdfsdjgf sdgjhfgsugfyusdg fyugs yugdfyusgiaufgasf sygfsatsfgsguof syu ysu gayfyusg fygsa uofgsyugo fyosfg ygsfyag yogasf yu..") }}</p>
            </div>
            <div class="col-1 my-auto mx-auto text-secondary">
            <em>{{__("Aujourd'hui à 11h30min")}}</em> 
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-1">
                <i class="bi bi-person-circle text-secondary h1"></i>
            </div>
            <div class="col-9 border rounded">
                <p class="text-secondary h5">{{__("Nom et prenom")}}</p>
                <p>{{ __("Contenu du message. afjksdfhs hgsjhfg kh gjhsgdfhgsdjhfg ksdhjfgs fksdhg ffsjdgfjf gsdfsdjgf sdgjhfgsugfyusdg fyugs yugdfyusgiaufgasf sygfsatsfgsguof syu ysu gayfyusg fygsa uofgsyugo fyosfg ygsfyag yogasf yu..") }}</p>
            </div>
            <div class="col-1 my-auto mx-auto text-secondary">
            <em>{{__("Aujourd'hui à 11h30min")}}</em> 
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-1">
                <i class="bi bi-person-circle text-secondary h1"></i>
            </div>
            <div class="col-9 border rounded">
                <p class="text-secondary h5">{{__("Nom et prenom")}}</p>
                <p>{{ __("Contenu du message. afjksdfhs hgsjhfg kh gjhsgdfhgsdjhfg ksdhjfgs fksdhg ffsjdgfjf gsdfsdjgf sdgjhfgsugfyusdg fyugs yugdfyusgiaufgasf sygfsatsfgsguof syu ysu gayfyusg fygsa uofgsyugo fyosfg ygsfyag yogasf yu..") }}</p>
            </div>
            <div class="col-1 my-auto mx-auto text-secondary">
            <em>{{__("Aujourd'hui à 11h30min")}}</em> 
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-1">
                <i class="bi bi-person-circle text-secondary h1"></i>
            </div>
            <div class="col-9 border rounded">
                <p class="text-secondary h5">{{__("Nom et prenom")}}</p>
                <p>{{ __("Contenu du message. afjksdfhs hgsjhfg kh gjhsgdfhgsdjhfg ksdhjfgs fksdhg ffsjdgfjf gsdfsdjgf sdgjhfgsugfyusdg fyugs yugdfyusgiaufgasf sygfsatsfgsguof syu ysu gayfyusg fygsa uofgsyugo fyosfg ygsfyag yogasf yu..") }}</p>
            </div>
            <div class="col-1 my-auto mx-auto text-secondary">
            <em>{{__("Aujourd'hui à 11h30min")}}</em> 
            </div>
        </div>

    </div>
    

@endsection
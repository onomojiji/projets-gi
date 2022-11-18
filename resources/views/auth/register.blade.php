<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{asset("favicon.ico")}}" type="image/x-icon">
    <title>Projets GI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  </head>
  <body>
    
    <div class="">
        <div class="row">
            <div class="col-md-4">
                <img class="img-fluid" style="height: 100vh; width: 100vw" src="{{asset("images/logo.png")}}" alt="enspd" srcset="">
            </div>
            <div class="col-md-8 my-auto py-5 py-md-0">
                <h1 class="">{{__("Inscrivez-vous")}}</h1>
                <div class="row shadow px-2 pt-md-3 pb-md-5 rounded">

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

                    <form action="{{route("register.store")}}" method="post">
                        @csrf
                        <div class="row my-3 form-group">
                            <div class="col-md-6">
                                <label for="name" class="form-label fw-bold">{{("Nom(s) et prenom(s)")}}</label>
                                <input type="text" class="form-control form-control-lg" id="name" name="name" autofocus required>
                            </div>
                            <div class="col-md-3">
                                <label for="sex" class="form-label fw-bold">{{("Sexe")}}</label>
                                <select class="form-select form-select-lg" aria-label=".form-select-lg example" id="sex" name="sex" required>
                                    <option value="M">{{__("Masculin")}}</option>
                                    <option value="F">{{__("Feminin")}}</option>
                                </select>                                  
                            </div>
                            <div class="col-md-3">
                                <label for="matricule" class="form-label fw-bold">{{("Matricule")}}</label>
                                <input type="text" class="form-control form-control-lg" id="matricule" name="matricule" required>
                            </div>
                        </div>

                        <div class="row my-3 form-group">
                            <div class="col-md-6">
                                <label for="birth_date" class="form-label fw-bold">{{("Date de naissance")}}</label>
                                <input type="date" class="form-control form-control-lg" id="birth_date" name="birth_date" required>
                            </div>
                            <div class="col-md-6">
                                <label for="birth_place" class="form-label fw-bold">{{("Lieu de naissance")}}</label>
                                <input type="text" class="form-control form-control-lg" id="birth_place" name="birth_place" required>
                            </div>
                        </div>

                        <div class="row my-3 form-group">
                            <div class="col-md-6">
                                <label for="email" class="form-label fw-bold">{{("Adresse email")}}</label>
                                <input type="email" class="form-control form-control-lg" id="email" name="email" required>
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label fw-bold">{{("Numero de telephone")}}</label>
                                <input type="tel" class="form-control form-control-lg" id="phone" name="phone" required>
                            </div>
                        </div>

                        <div class="row my-3 form-group">
                            <div class="col-md-6">
                                <label for="password" class="form-label fw-bold">{{("Mot de passe")}}</label>
                                <input type="password" class="form-control form-control-lg" id="password" name="password" required>
                            </div>
                            <div class="col-md-6">
                                <label for="confirmpassword" class="form-label fw-bold">{{("Confirmation")}}</label>
                                <input type="password" class="form-control form-control-lg" id="confirm" name="confirmpassword" required>
                            </div>
                        </div>

                        <div class="row">
                            <button type="submit" class="btn btn-primary btn-lg w-50 mx-auto">{{__("S'inscrire")}}</button>
                        </div>
                        
                        <div class="my-3">
                            <a href="{{route("login")}}">{{__("Je suis ancien, j'ai deja un compte.")}}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>

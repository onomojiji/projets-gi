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
            <div class="col-md-8">
                <img class="img-fluid" style="height: 100vh; width: 100vw" src="{{asset("images/enspd.jpg")}}" alt="enspd" srcset="">
            </div>
            <div class="col-md-4 my-auto py-5 py-md-0">
                <h1 class="">{{__("Bienvenue, connectez vous pour continuer !")}}</h1>
                <div class="row shadow px-2 pt-md-2 pb-md-5 rounded">
                    <form action="" method="post">
                        <div class="my-3">
                            <label for="matricule" class="form-label fw-bold">{{("Matricule")}}</label>
                            <input type="text" class="form-control form-control-lg" id="matricule" name="matricule" autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold">{{__("Mot de passe")}}</label>
                            <input type="password" class="form-control form-control-lg" id="password" name="password">
                        </div>
                        <div class="my-3">
                            <a href="#">{{__("Mot de passe oublie.?")}}</a>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg w-100">{{__("Se connecter")}}</button>                        
                        <div class="my-3">
                            <a href="{{route("register")}}" class="text-secondary">{{__("Je suis nouveau, je n'ai pas de compte.")}}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>

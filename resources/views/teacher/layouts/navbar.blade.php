<header class="fixed-top">
  <nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{route("teacher.home")}}"><img src="{{asset("images/logo.png")}}" width="50" height="50" alt=""><span class="px-1 text-primary">{{__("PROJETS GI")}}</span></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{route("teacher.home")}}">{{("Accueil")}}</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route("teacher.classes.index")}}">{{__("Mes cours")}}</a>
          </li>
        </ul>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="{{("Rechercher un projet")}}" aria-label="Search">
          <button class="btn btn-outline-primary" type="submit">{{__("Rechercher")}}</button>
        </form>

        <ul class="navbar-nav">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              {{ Auth::user()->name }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="#">{{__("Mon Profil")}}</a></li>
              <li><div class="dropdown-divider"></div>
                <form method="POST" action="{{ route('logout')}}" class="dropdown-item" >
                  @csrf 
                  <div class="row">
                    <div class="col">
                      <button type="submit" class="btn btn-light text-danger col"><span><i class="fas fa-power-off text-danger"></i></span>{{__(" Deconnexion")}}</button>
                    </div>
                  </div>
                </form>
              </li>
            </ul>
          </li>
        </ul>

      </div>
    </div>
  </nav>
</header>

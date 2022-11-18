
@extends("errors.layout")

@section("title")
    {{__("404 - Projets GI")}}
@endsection

@section("code")
    {{__("404")}}
@endsection

@section("message-title")
    {{__("Oups nous n'avons pas pu trouver cette page !")}}
@endsection

@section("message-content")
    {{__("le lien auquel vous faites reference n'existe pas ou a été supprimé !")}}
@endsection

@section("action-button")
    
    <a rel="noopener noreferrer" href="{{route("login")}}" class="px-8 py-3 font-semibold rounded bg-blue-600 text-gray-50 md-uppercase">
        <font style="vertical-align: inherit;">
            <font style="vertical-align: inherit;">{{__("Retourner a l'accueil")}}</font>
        </font>
    </a>
    
@endsection
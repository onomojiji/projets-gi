@extends("errors.layout")

@section("title")
    {{__("403 - eBULL-CTD")}}
@endsection

@section("code")
    {{__("403")}}
@endsection

@section("message-title")
    {{__("Non autorisé")}}
@endsection

@section("message-content")
    {{__("Vous n'avez pas le droit d'accéder à cette page")}}
@endsection

@section("action-button")
    <form action="{{route("logout")}}" method="post">
        @csrf
        <button class="px-8 py-3 font-semibold rounded bg-red-600 text-gray-50 md-uppercase" type="submit">{{__("Deconnexion")}}</button>
    </form>
@endsection
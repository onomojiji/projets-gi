@extends("errors.layout")

@section("title")
    {{__("419 - eBULL-CTD")}}
@endsection

@section("code")
    {{__("419")}}
@endsection

@section("message-title")
    {{__("Session expiré !")}}
@endsection

@section("message-content")
    {{__("Votre session a expiré.")}}
@endsection

@section("action-button")

    <a rel="noopener noreferrer" href="{{route("login")}}" class="px-8 py-3 font-semibold rounded bg-blue-600 text-gray-50 md-uppercase">
        <font style="vertical-align: inherit;">
            <font style="vertical-align: inherit;">{{__("Connecter vous à nouveau")}}</font>
        </font>
    </a>
@endsection
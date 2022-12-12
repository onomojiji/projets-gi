@extends("student.layouts.app")

@section("content")
    <div class="row">
        <p class="h2">{{__("Resultat des recherches pour : ")}} <span class="text-info">{{ $word }}</span></p>
        <hr>
    </div>
    <div class="row">
        @if (count($projects) > 0)
            @foreach ($projects as $project)
                <div class="col">
                    <div class="card mb-5" style="width: 18rem;">
                        <img src="{{asset("images/file-zip.png")}}" height="200" class="card-img-top" alt="...">
                        <div class="card-body">
                                <h5 class="card-title text-info">{{ $project['note'] }}</h5>
                                    <p style="display: -webkit-box;
                                    -webkit-line-clamp: 3;
                                    -webkit-box-orient: vertical;
                                    overflow: hidden;
                                    text-overflow: ellipsis;" class="card-text text-secondary">
                                        {{ $project['project']->theme }} <br class="mb-2">
                                    </p>
                            
                        </div>
                        <div class="card-footer">
                            <a href="{{route("student.groups.show", ['id' => $project['project']->id, 'classe_id' => $project['classe']])}}" class="btn btn-primary w-100">{{__("Voir le projet")}}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p class="h4 text-secondary text-center">{{__("Aucun projet touvé avec ce mot clé...")}}</p>
        @endif
    </div>
@endsection

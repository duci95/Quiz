<div class="content">
    <div class="row m-2 d-flex justify-content-between">
        <span class="btn btn-success badge p-2 insert align-content-center text-center">Dodaj kategoriju</span>
    </div>

    @foreach($categories as $cat)
        <div class="row justify-content-around border-bottom border-top p-2  m-2">
        <span class="col-4 justify-content-between">
            <a href="{{route('one',['id' => $cat->id])}}" class="text-white btn badge p-2 mr-3 btn-info">{{$cat->category_name}}</a>
            <a href="{{route('statistics.show',['statistic' => $cat->id])}}" class="text-white badge btn p-2 btn-info">Rezultati</a>
        </span>
            <span class="col-6">
            <span class="text-info badge">{{$cat->description}}</span>
        </span>
            <span data-category="{{$cat->id}}" class="edit btn btn-primary d-flex badge p-2 justify-content-end">Izmeni</span>
            <span data-category="{{$cat->id}}" class="delete btn btn-danger d-flex justify-content-end badge p-2 ">Obriši</span>
        </div>
    @endforeach
</div>
@section('functions')
    <script src="{{asset("/")}}js/regexPatterns.js"></script>
    <script src="{{asset("/")}}js/functions.js"></script>
@endsection

@section('scripts')
    <script src="{{asset("/")}}js/moderator/categories.js"></script>
@endsection

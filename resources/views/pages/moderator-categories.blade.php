<div class="row m-2 d-flex justify-content-between">
    <span class="btn btn-success badge p-2 insert text-center">Dodaj kategoriju</span>
    <a href="{{route('statistics-all-users')}}" class="btn btn-warning badge p-2  text-center">Prikaz rezultata po korisniku</a>
</div>
<div class="content">
    @foreach($categories as $cat)
        <div class="row justify-content-between m-auto border-bottom border-top p-2 m-2 w-75">
        <span class="col-2 w-100 row">
            <a href="{{route('one',['id' => $cat->id])}}" class=" w-100 text-white btn badge p-2 mr-3 btn-info">{{$cat->category_name}}</a>
        </span>
            <span class="col-2 row">
                <a href="{{route('statistics.show',['statistic' => $cat->id])}}" class="  text-white badge btn p-2 btn-info ">Rezultati</a>
            </span>
        <span class="col-5 row justify-content-start align-content-center">
            <span class="text-info badge">{{$cat->description}}</span>
        </span>
            <span class="col-3 row justify-content-end">
                <span data-category="{{$cat->id}}" class="mr-2 edit-category btn btn-primary badge p-2">Izmeni</span>
                <span data-category="{{$cat->id}}" class="delete-category btn btn-danger badge p-2">Obriši</span>
            </span>
        </div>
    @endforeach
</div>
@section('functions')
    <script src="{{asset("/")}}js/regexPatterns.js"></script>
    <script src="{{asset("/")}}js/functions.js"></script>
@endsection
@section('scripts')
    <script src="{{asset("/")}}js/moderator/categories.js"></script>
    @if(session()->has('empty'))
        <script>
            bootbox.alert('Nema rezultata za ovu kategoriju!')
        </script>
    @endif
@endsection

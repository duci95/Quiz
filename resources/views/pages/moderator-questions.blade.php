@extends('layouts.master')
@section('header')
        @include('partials.header')
@endsection
@section('content')
<div class="container content">
    <div class="row m-2 d-flex justify-content-between">
        <span class="btn btn-success insert align-content-center text-center">Dodaj pitanje</span>
    </div>
    @foreach($questions as $questionNo => $question)
        <div class="d-flex flex-row justify-content-between">
{{--        <span class="col-4">--}}
{{--            <a href="{{route('answers.index',['id' => $question->id])}}" class="text-white btn btn-info">{{$question->question}} ?</a>--}}
{{--        </span>--}}
{{--            <span data-category="{{$question->id}}" class="edit btn btn-primary">Izmeni</span>--}}
{{--            <span data-category="{{$question->id}}" class="delete btn btn-danger d-flex justify-content-end ">Obriši</span>--}}
            <div class="card d-flex">
                <div class="card-header justify-content-around d-flex p-1 flex-row">
                    <span data-category='{{$question->category_id}}' data-question="{{$question->id}}" class="question p-1 badge">{{$question->question}} ?</span>
                    <span class="btn p-1 btn-primary badge">Izmeni</span>
                </div>
                <div class="card-body d-flex p-1  flex-column">
                    @foreach($question->answers as $answer)
                        <div class=" justify-content-between">
                            @if($answer->true === 1)
                            <label class="bg-success text-white p-1 badge" for="{{$answer->id}}">{{$answer->answer}}</label>
                            <input id="{{$answer->id}}" data-id="{{$answer->id}}" name="{{substr($question->question,0,10)}}" type="radio" class="radio" checked="checked"/>
                            @else
                            <label class="p-1 badge" for="{{$answer->id}}">{{$answer->answer}}</label>
                            <input id="{{$answer->id}}" data-id="{{$answer->id}}" name="{{substr($question->question, 0,10)}}" class='radio' type="radio"/>
                            @endif
                            <span class="btn btn-primary badge">Izmeni</span>
                            <span class="btn btn-danger badge">Obriši</span>
                        </div>
                    @endforeach
                </div>
                <div class="card-footer p-1 d-flex justify-content-around">
                    <span class="btn btn-success badge">Dodaj odgovor</span>
                    <span class="btn btn-danger badge">Obriši pitanje</span>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
@section('functions')
    <script src="{{asset("/")}}js/functions.js"></script>
@endsection
@section('scripts')
    <script src="{{asset("/")}}js/moderator/questions.js"></script>
@endsection

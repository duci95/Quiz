@extends('layouts.master')
@section('header')
        @include('partials.header')
@endsection
@section('content')
<div class="container content">
    <div class="row m-2 d-flex justify-content-between">
        <span class="btn btn-success insert-q align-content-center text-center">Dodaj pitanje</span>
    </div>
    <div class="row">
    @foreach($questions as $questionNo => $question)
                <div class="card m-2">
                    <div class="card-header p-1">
                        <span data-category='{{$question->category_id}}' data-question="{{$question->id}}" class="question p-1 badge">{{$question->question}}</span>
                        <span class="btn badge btn-primary ml-5 edit-q"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
                        <span class="btn btn-danger delete-q badge"><i class="fa fa-times" aria-hidden="true"></i></span>
                    </div>
                    <div class="card-body p-1">
                        @foreach($question->answers as $answer)
                            <div class="justify-content-around">
                                @if($answer->true === 1)
                                    <label class="bg-success text-white badge" for="{{$answer->id}}">{{$answer->answer}}</label>
                                    <input id="{{$answer->id}}" data-id="{{$answer->id}}" name="{{substr($question->question,0,10)}}" type="radio" class="radio  mr-1" checked="checked"/>
                                @else
                                    <label class="p-1 badge" for="{{$answer->id}}">{{$answer->answer}}</label>
                                    <input id="{{$answer->id}}" data-id="{{$answer->id}}" name="{{substr($question->question, 0,10)}}" class='radio mr-1' type="radio"/>
                                @endif
                                    <span class='float-right'>
                                    <span class="btn badge edit-a btn-primary " data-category='{{$question->category_id}}' data-id="{{$answer->id}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
                                    <span class="btn btn-danger delete-a badge" data-category='{{$question->category_id}}' data-id="{{$answer->id}}"><i class="fa fa-times" aria-hidden="true"></i></span>
                                </span>
                            </div>
                        @endforeach
                    </div>
                    <div class="card-footer p-1 d-flex justify-content-around">
                        <span class="btn btn-success badge">Dodaj odgovor</span>
                    </div>
            </div>
    @endforeach
</div>
</div>
@endsection
@section('functions')
    <script src="{{asset("/")}}js/functions.js"></script>
@endsection
@section('scripts')
    <script src="{{asset("/")}}js/moderator/questions.js"></script>
@endsection

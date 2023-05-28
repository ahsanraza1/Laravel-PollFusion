@extends('layouts.master')

@section('title', '- All Polls')

@section('content')
    <div class="container mt-5 pt-3">
    <div class="container mt-5 pt-3">
        <div class="row my-2 border">
            <div class="col-sm-12">
                @if( isset( $poll ) )
                    <div class="h4 text-primary">{{ $poll['poll']['poll_name'] }}</div>
                        <div class="row border-bottom-0">
                            <!-- <div class="col-sm-6 text-muted">Poll by : {{ $poll['poll']['poll_creator'] }}</div> -->
                            <!-- <div class="col-sm-6 text-muted">Total Votes : {{ $poll['poll']['votes'] }}</div> -->
                        </div>
                        
                        <div class="row">
                            @if( count($poll['options']) > 0 )
                                <form class="" method="POST" action="{{ url('/poll/castvote') }}">
                                    @csrf
                                    <input type="hidden" id="pp" name="poll_id" value="{{ $poll['poll']['id'] }}">
                                    <div class="row p-2">
                                        @foreach( $poll['options'] as $op )
                                        <div class="container col-sm-6 form-check justify-content-center p-3 border border-muted">
                                            @if( isset($isv) && $isv['option_id']==$op['id'])
                                            <input class="form-check-lg" type="radio" 
                                            {{ isset($isv) ? 'disabled':''}} id="{{ $op['id'] }}" name="option_id" value="{{ $op['id'] }}" checked >
                                            @else
                                            <input class="form-check-lg" type="radio" 
                                            {{ isset($isv) ? 'disabled':''}} id="{{ $op['id'] }}" name="option_id" value="{{ $op['id'] }} "  >
                                            @endif
                                            <span class="fw-bold"> {{ $op['option_txt'] }}</span>
                                        </div>    
                                        @endforeach
                                    </div>
                                    <div class="row justify-content-center p-2 ">
                                        <div class="col-sm-1 p-2">
                                        <input type="submit" class="btn btn-primary btn-lg" value="{{ isset($isv) ? 'VOTED':'VOTE'}}" 
                                            {{ isset($isv) ? 'disabled':''}}>
                                        </div>
                                    </div>
                                </form>
                            @else
                                
                            @endif
                        </div>
                    </div>

                @endif
            </div>
        </div>
    </div>

@endsection
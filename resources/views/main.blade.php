@extends('layouts.master')

@section('title', '- All Polls')

@section('content')
    <div class="container mt-5 pt-3">
        <div class="row my-2">
            @if( isset( $polls ) )
                @foreach( $polls as $poll)
                <div class="col-sm-6">
                            <a class="text-decoration-none" href="{{ url('/poll/show') }}?id={{$poll['poll']['id']}}">
                            <div class="container my-2 border">
                                <div class="h4 text-primary">{{ $poll['poll']['poll_name'] }}</div>
                                <div class="row border-bottom">
                                    <div class="col-sm-6 text-muted">Poll by : {{ $poll['poll']['poll_creator'] }}</div>
                                    <div class="col-sm-6 text-muted">Total Votes : {{ $poll['totalVotes'] }}</div>
                                </div>
                                
                                <div class="row mt-2">
                                    @if( count($poll['options']) > 0 )
                                        @foreach( $poll['options'] as $op )
                                            
                                                <div class="col-sm-6 text-muted">
                                                    <div class="row p-2 text-success fw-bold">
                                                        {{ $op['option_txt'] }}
                                                    </div>
                                                    <div class="row justify-content-center p-2">
                                                        <!-- <div class="vote-bar">
                                                            <div class="vote-bar-fill" style="width: {{$op['votes'] }}%">
                                                                <span class="bartxt" style="color:'#fff'">
                                                                    {{ $op['votes']}} %
                                                                </span>
                                                            </div>
                                                        </div> -->
                                                            
                                                                <div class="progress">
                                                                    <div class="progress-bar bg-secondary" style="width: {{ $op['votes'] }}%">
                                                                        {{ $op['votes'] }}%
                                                                    </div>
                                                                </div>
                                                            
                                                    </div>
                                                <!-- <div class="col-sm-6 border text-muted">Total Votes : {{ $poll['totalVotes'] }}</div> -->
                                                </div>
                                            <!-- <br> -->
                                        @endforeach
                                    @else
                                        <br>-------Nuosb-----<br>
                                    @endif
                                    
                                </div>
                            </div>
                        </a>
                        </div>
                @endforeach
            @endif
        </div>
    </div>

@endsection
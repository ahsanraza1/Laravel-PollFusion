<div>
@foreach ( $polls as $poll)
    <br>
    {{$poll->poll_name}}
    <a href="{{ url('/poll/options') }}?id={{$poll->id}}">Add Options</a>
@endforeach
</div>
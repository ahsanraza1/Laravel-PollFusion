@extends('layouts.master')

@section('title', '- All Polls')

@section('content')
    <div class="container mt-5 pt-3">
        <div class="container mt-5 pt-3">
            <div class="card">
                <form id="theform" action="{{ url('/poll/create') }}" method="POST">
                    @csrf    
                    <div class="card-header">Create New Poll</div>
                    
                    <div class="card-body">
                        <label class="form-label" for="poll_name">Poll Name:</label>
                        <input class="form-control form-control-md" type="text" name="poll_name" id="poll_name" required>

                        <div class="container mt-3 p-3" id="optionsdiv">
                            <div class="row border" id="optionsdiv">
                            </div>
                        </div>
                        <div>
                            @if( isset($errors))
                                @foreach( $errors->all() as $error )
                                    <li>{{$error }}</li>
                                @endforeach
                            @endif
                        </div>
                    
                    </div>
                    
                    <div class="card-footer">
                        <div class=" justify-content-center">
                            <button id="moreOp" class="btn btn-success">Add Option</button>
                            <button type="submit" class="btn btn-primary" id="subb">Create Poll</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


<script>
                //     <label class="form-label" for="poll_name">Poll Name:</label>
                // <input class="form-control form-control-md" type="text" name="poll_name" id="poll_name" required>

    var subb = document.getElementById('subb');
    var bt = document.getElementById('moreOp');
    var sub = document.getElementById('subf');
    // subb.onclick = function (){
    //     event.preventDefault();
    //     inp = document.getElementsByClassName("sin");
    //     console.log(inp.length);
    //     t = 0;

    //     for(i=0; i<inp.length; i++){ 
    //         r = inp[i].value;
    //         if( r.length==0|| r=='' ||r.length==' ' ){
    //             t++;
    //             console.log("wow"+i);
    //         }else{
    //             // console.log(inp[i].value);
    //         }
    //     }
    //     console.log("val t : "+t);
    // }
    bt.onclick = function (){
        event.preventDefault();
        var div = document.getElementById('optionsdiv');
        
        const lbl = document.createElement('label');
        lbl.setAttribute('class', 'form-label');
        lbl.innerHTML = "Poll Option : "
                            
        const inp = document.createElement('input');
        inp.setAttribute('type', 'text');
        inp.setAttribute('class', 'form-control form-control-md sin');
        inp.setAttribute('name', 'optiontxt[]');

        div.appendChild(lbl);
        div.appendChild(inp);
    }

</script>


@endsection
<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use App\Models\Vote;
use App\Models\Option;
use App\Models\User;
use Auth;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
class PollsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index( Request $request)
    {
        $uid = Auth::id();
        if ( $request->query('q')== 'm'){

            $polls = Poll::where('poll_creator', $uid)->orderBy('created_at', 'desc')->get();
        }else{

            $polls = Poll::orderBy('created_at', 'desc')->get();//where('poll_creator', $uid)->get();
        }
        // return view('my_polls')->with('polls',$polls);
        $data = array();

        foreach( $polls as $poll){
            $OnePoll = array();
            $options = Option::where('poll_id', $poll->id)->get();
            $totalVotes = 0;
            for ($i =0; $i<count($options); $i++) {
                $opv = $options[$i];
                $totalVotes += $opv['votes'];
            }
            for ($i =0; $i<count($options); $i++) {
                $opv = $options[$i];
                $pr= ($totalVotes==0)?0:(($opv['votes']/$totalVotes)*100);
                $opv['votes'] = round( $pr );
            //     $vts = Vote::where(
            //         [
            //             'poll_id'=> $pollid,
            //             'option_id'=> $opv->id;
            //         ]
            //         )->count();
            //     if( $vts ){
            //         $options[$i]['votes']
            //     }
            }
            $poll['poll_creator'] = User::find($poll->poll_creator)->name;
            $OnePoll['poll'] = $poll;
            $OnePoll['options'] = $options;
            $OnePoll['totalVotes'] = $totalVotes;
            array_push($data, $OnePoll);
            // $OnePoll['name'] = $poll->poll_name;
        }

        return view('main')->with("polls", $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function showPoll( Request $request)
    {
        $pollid = $request->query('id');

        $uid = Auth::id();
        $vote = Vote::where( 
            [
                'user_id'=> $uid,
                'poll_id'=> $pollid
            ]
        )->first();
        
        $poll = Poll::find( $pollid);//->get();
        // return view('my_polls')->with('polls',$polls);
        // $data = array();
        $OnePoll = array();
        $options = Option::where('poll_id', $poll->id)->get();
        $OnePoll['poll'] = $poll;
        $OnePoll['options'] = $options;
        // array_push($data, $OnePoll);
            // $OnePoll['name'] = $poll->poll_name;

            if( $vote ){
                return view('vote')->with("poll", $OnePoll)->with('isv', $vote);
            } else{
                return view('vote')->with("poll", $OnePoll);
            }
        // return view('vote')->with('pid', $pollid);

    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make( $request->all(),[
            
            'poll_name'=>'required',
            'optiontxt.*' => 'required|string',

        ]);
        $validatedData = $validator->validated();
        $errors = $validator->errors();
        if ( !$request->has('optiontxt') ){
            $errors->add('Option Fields', 'Must include atleast one option');
            return redirect()->back()->withErrors($errors)->withInput();
        }
        elseif( $validator->fails())
        {
            
            $areEmpty = TRUE;
            
            foreach ($request->input('optiontxt') as $fs) {
                if( !empty(trim($fs))){
                    $areEmpty = FALSE;
                    break;
                }
            }

            if( $areEmpty){
                $errors->add('Options', 'Atleast one option is required');
            }
            return redirect()->back()->withErrors($errors)->withInput();
        }else{
            try{
                $options  = $request->input('optiontxt');
                $validatedData['poll_creator'] = Auth::id();
                $validatedData['options'] = count($options);
                
                
                $poll = Poll::create($validatedData);

                if( $poll->id ){
                    foreach( $options as $option ){
        
                        $optionsData = array();
                        $optionsData['poll_id'] = $poll->id;
                        $optionsData['option_txt'] = $option;
                        $optionsData['votes'] = 0;
                        $opt = Option::create($optionsData);
                        
                        if( !$opt->id){
                            $errors-add('OPtions', 'Something gone wrong');
                            return redirect()->back()->withErrors($errors)->withInput();
                            exit();
                        }
                    }
                    return redirect()->route('allpolls');
                    // return view('NewPoll')->with('tst', $validatedData)->with('pollid', $poll->id);
                }else{
                    // return view('NewPoll')->with('tst', $validatedData)->with('pollid', "jghhhvjhj");
                }
            }catch(e){
                $errors-add('Options', 'Something gone wrong');
                return redirect()->back()->withErrors($errors)->withInput();
            }

        }


        
        

        // return redirect()->route('pollForm')->with('pollid', $poll->id);
        
        // ->with('pollid', $poll->id)->with('num_options',$request->get('options'));
    }
    public function vote(Request $request)
    {
        //
        $validatedData = $request->validate([
            
            'poll_id'=>'required',
            'option_id'=>'required',

        ]);

        $uid = Auth::id();
        $vt = Vote::where( 
            [
                'user_id'=> $uid,
                'poll_id'=> $request->get('poll_id')
            ]
        )->count();
        if( $vt < 1 ){
            // $vote  = $request->input('pollOp');

            $validatedData['user_id'] = Auth::id();
            // $validatedData['option_id'] = count($options);
            
            
            $vote = Vote::create($validatedData);

            $ups = Option::find($request->get('option_id'))->increment('votes');
            // if( $poll->id ){
            //     foreach( $options as $option ){

            //         $optionsData = array();
            //         $optionsData['poll_id'] = $poll->id;
            //         $optionsData['option_txt'] = $option;
            //         $optionsData['votes'] = 0;
            //         $opt = Option::create($optionsData);
                    
            //         if( !$opt->id){
            //             exit();
            //         }
            //     }
            if( $ups){
                return redirect()->route('allpolls');
                // return view('vote')->with('tst', $validatedData)->with('voteid', $vote->id);
            }else{
                // return view('NewPoll')->with('tst', $validatedData)->with('pollid', "jghhhvjhj");
            }
        }else{
            
        }

        // return view("vote")->with("optione", $vote);
        // return redirect()->route('pollForm')->with('pollid', $poll->id);
        
        // ->with('pollid', $poll->id)->with('num_options',$request->get('options'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Poll $poll)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Poll $poll)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Poll $poll)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Poll $poll)
    {
        //
    }
}

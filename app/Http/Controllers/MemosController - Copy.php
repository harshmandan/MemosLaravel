<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Memo;

class MemosController extends Controller
{

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$memos = Memo::all();
        $memos = Memo::orderBy('created_at', 'asc')->paginate(5);
        return view('memos.index')->with('memos', $memos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('memos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'body' => 'required'
        ]);
        $memo = new Memo;
        $memo->title = $request->input('title');
        $memo->body = $request->input('body');
        $memo->user_id = auth()->user()->id;
        $memo->save();

        return redirect('/memos')->with('success', 'Memo Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $memo = Memo::find($id);
        return view('memos.show')->with('memo',$memo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $memo= Memo::find($id);

        //check for user
        if(auth()->user()->id != $memo->user_id)
        {
            return redirect('/memos')->with('error','Unauthorized page');
        }

        return view('memos.edit')->with('memo',$memo);
    }

    public function delete($id)
    {
        $memo= Memo::find($id);
        //check for user
        if(auth()->user()->id != $memo->user_id)
        {
            return redirect('/memos')->with('error','Unauthorized page');
        }
        return view('memos.delete')->with('memo',$memo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title' => 'required',
            'body' => 'required'
        ]);
        $memo = Memo::find($id);
        $memo->title = $request->input('title');
        $memo->body = $request->input('body');
        $memo->save();

        return redirect('/memos')->with('success', 'Memo Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $memo = Memo::find($id);
        //check for user
        if(auth()->user()->id != $memo->user_id)
        {
            return redirect('/memos')->with('error','Unauthorized page');
        }
        $memo->delete();
        return redirect('/memos')->with('success', 'Memo deleted successfully!');
    }
}

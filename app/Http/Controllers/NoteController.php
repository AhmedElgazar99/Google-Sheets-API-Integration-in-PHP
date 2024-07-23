<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\note;
use Illuminate\Support\Facades\Http;

class NoteController extends Controller
{
    public function token(){
       
       return csrf_token();

   
    }

    public function index(){
        $notes=note::all();
        return view('note.index',["notes"=>$notes]);
    }
    
    
    //show all items
    public function index2()  {

    return response()->json(note::all());        
    }

    //show specific item by id
    public function show($id){
        $note=note::find($id);
        return response()->json($note);
    }

    //updat
    public function update(Request $request,$id){
        
        $note=note::find($id);
        
        
        $note->update(request()->all());
        // $note->title=$request->title;
        // $note->note=$request->note;
        //$note->save();
       // dd($note);
        return response()->json($note);
    }

    public function destroy($id){
        
        $note=note::destroy($id);
        
        
        return response()->json($note);
    }

    public function store(Request $request){
        $val=$request->validate([
            "title"=>'required|max:100|string',
            "note"=>'required',
        ]);
        
        $note=note::create(request()->all());
        
        
        return response()->json($note);
    }
}

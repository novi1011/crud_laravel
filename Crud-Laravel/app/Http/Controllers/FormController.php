<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FormFactory;
use DB;

class FormController extends Controller
{
    public function index(Request $request){
        $forms=FormFactory::where('title','like', "%{$request->get('cari')}%")
        ->orWhere('desc','like', "%{$request->get('cari')}%")
        ->orderBy('id','DESC')
        ->paginate(5);  

        return view('form/index', compact('forms'));

    }

    public function create(){
        return view('form/create');
    }

    public function store(Request $request){
        $request->validate([
            'title'=> 'required|min:5',
            'desc'=> 'required|min:5|max:50',  
        ]);

        $forms=new FormFactory;
        $forms->title = $request->title;
        $forms->desc = $request->desc;
        $forms->save();

        return redirect ('/form');
    }

    public function edit($id){
        $forms= FormFactory::find($id);
        return view ('form.edit', ['forms' => $forms]);

    }

    public function update(Request $request, $id){
        $forms= FormFactory::find($id);
        $forms->title = $request->title;
        $forms->desc = $request->desc;
        $forms->save();
        
        return redirect()->route ('form.index'); 
    }

    public function destroy($id){
        $forms=FormFactory::find($id);
        $forms->delete();
        return redirect('form');
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        DB::table("forms")->whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=>"Products Deleted successfully."]);
    }

    public function show($id){
        $forms= FormFactory::find($id);

        return view('form/show', ['forms' => $forms]);
    }



}

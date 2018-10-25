<?php

namespace App\Http\Controllers;

use App\Illustration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DB;

class IllustrationsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:director');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $illustrations = Illustration::orderBy('created_at', 'dsc')->paginate(10);
        return view('illustrationposts.index')->with('illustrations', $illustrations);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('illustrationposts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'image' => 'image|max:1999',
          'image' => 'required',
        ]);
/**
        ///Handle File Upload
        if($request->hasFile('calamityImage')){
            // Get filename with the extension
            $filenameWithExt = $request->file('calamityImage')->getClientOriginalName();
            // Get just file name
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('calamityImage')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('calamityImage')->storeAs('images/', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        **/

      $filename = $request->file('image')->getClientOriginalName();
      $moveImage = $request->file('image')->move('illustrationImage', $filename);

        //Create Illustration
        $illustration = new Illustration;
        $illustration->name = $request->input('name');
        $illustration->description = $request->input('description');
        $illustration->image = $filename;
        $illustration->save();

        return redirect('/illustrationposts')->with('success', 'Illustration Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $illustration = Illustration::find($id);
        return view('illustrationposts.show')->with('illustration', $illustration);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $illustration = Illustration::find($id);
        return view('illustrationposts.edit')->with('illustration', $illustration);

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

        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'image' => 'image|max:1999',
            'image' => 'required',
        ]);

        $filename = $request->file('image')->getClientOriginalName();
        $moveImage = $request->file('image')->move('illustrationImage', $filename);

        //Update Illustration
        $illustration = Illustration::find($id);
        $illustration->name = $request->input('name');
        $illustration->description = $request->input('description');
        if($request->hasFile('image')){
            $illustration->image = $filename;
        }
        $illustration->save();

        return redirect('/illustrationposts')->with('success', 'Illustration Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $illustration = Illustration::find($id);
        $illustration->delete();

        if($illustration->images != 'noimage.jpg'){
            //Delete Image
            Storage::delete('illustrationImage/'.$illustration->image);
        }

        return redirect('/illustrationposts')->with('success', 'Illustration Deleted');
    }
}

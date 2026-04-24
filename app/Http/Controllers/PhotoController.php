<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $photos = Photo::latest()->paginate(9); // pagination
    return view('upload', compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('upload');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeSingle(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:4080',
        ]);
            
            $image = $request->file('image');
            $name = time().'_'.$image->getClientOriginalName();
            $image->move(public_path('images'), $name);
            
            Photo::create(['image' => $name]);

        return back()->with('success', 'Single image uploaded successfully!');
    }   
    
    public function storeMultiple(Request $request){
        $request->validate([

'images.*' => 'required|image|mimes:jpg,jpeg,png,gif|max:4080',

]);

foreach ($request->file('images') as $image) {

$name = time().'_'.$image->getClientOriginalName();

$image->move(public_path('images'), $name);

Photo::create(['image' => $name]);

}

return back()->with('success', 'Multiple images uploaded successfully!');
}


    /**
     * Display the specified resource.
     */
    public function show(Photo $photo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Photo $photo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Photo $photo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $photo = Photo::findOrFail($id);

    $imagePath = public_path('images/' . $photo->image);

    // Only delete if the file exists and is not a directory
    if (file_exists($imagePath) && is_file($imagePath)) {
        unlink($imagePath);
    }

    $photo->delete();

    return redirect()->route('photos.index')->with('success', 'Photo deleted successfully.');
}

}

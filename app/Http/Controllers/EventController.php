<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Type;


class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        $types = Type::all();
        return view('event.add', compact('types'));
    }

    public function store(Request $request){

        $validatedData = $request->validate([
                'name' => 'required',
                'description' => 'required',
                'type' => 'required',
                'event_image' => 'required|image|mimes:png,jpeg,gif'
            ], [
                'name.required' => 'Name is required.',
                'description.required' => 'Description is required.',
                'type.required' => 'Type is required.',
                'event_image.required' => 'Event Image is required.'
            ]);

        $event_input = $request->all();
        // dd($event_input);
        $original_name = $request->event_image->getClientOriginalName();
        $after_name = time().$original_name;

        $request->event_image->move(public_path('event_images'), $after_name);

        $event = Event::create([
            'name' => $event_input['name'],
            'description' => $event_input['description'],
            'type_id' => $event_input['type'],
            'image' => $after_name
        ]);

        if($event){
            return redirect()->route('home')->with('success_added', 'Product successfully added.');
        }else{
            return redirect()->route('home')->with('failed_added', 'Product failed to add.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // $event_id = $_GET['id'];
        $event = Event::find($id);
        $types = Type::all();
        return view('event.edit', compact('event', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'type' => 'required',
        ], [
            'name.required' => 'Name is required.',
            'description.required' => 'Description is required.',
            'type.required' => 'Type is required.',
            'event_image.required' => 'Event Image is required.'
        ]);
        
        if($request->event_image){
            $validatedData = $request->validate([
                'event_image' => 'required|image|mimes:png,jpeg,gif'
            ], [
                'event_image.required' => 'Event Image is required.'
            ]);
        }

        $event_row = Event::find($request->id);
        if(isset($request->event_image)){

            $delete_old_image = public_path('event_images/');
            unlink($delete_old_image.$event_row->image);

            $original_name = $request->event_image->getClientOriginalName();
            $file_name_after = time().$original_name; 
            $request->event_image->move(public_path('event_images'), $file_name_after); 

            $event_row->image = $file_name_after;
        }
        $event_row->name = $request->name;
        $event_row->description = $request->description;
        $event_row->type_id = $request->type;

        $update = $event_row->save();
        if($update){
            return redirect()->route('home')->with('success_added', 'Successfully updated event.');
        }else{
            return redirect()->route('home')->with('failed_added', 'Failed to updated event.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $image_path = public_path('event_images/');
        $event = Event::find($id);

        if($event->image != null){
            unlink($image_path.$event->image);
        }

        if($event->delete()){
            return redirect()->route('home')->with('success_added', 'Event successfully deleted.');
        }else{
            return redirect()->route('home')->with('failed_added', 'Event failed to delete');
        }
    }

    

}

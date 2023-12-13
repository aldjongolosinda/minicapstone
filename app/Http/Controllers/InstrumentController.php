<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Events\UserLog;
use App\Models\Category;
use App\Models\Instrument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class InstrumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchInstrument(Request $request)
    {
        $search = $request->search;

        $instruments = Instrument::with('category')
            ->where(function ($query) use ($search) {
                $query->where('name', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%");
            })
            ->orWhereHas('category', function ($categoryQuery) use ($search) {
                $categoryQuery->where('name', 'like', "%$search%");
            })
            ->orderBy('created_at', 'asc')
            ->get();

        return view('instrument.index', compact('instruments', 'search'));
    }

    public function instrumentCategory(Category $category){

        // $instruments = Instrument::where('category_id', $category->id)->orderBy('id', 'asc')->get();
        $instruments = Instrument::where('category_id', $category->id)->get();

        return view('customer.instrument_category', compact('category', 'instruments'));
    }

    public function index()
    {
        $instruments = Instrument::all();
        return view('instruments.index', compact('instruments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('instruments.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // try {
            $request->validate([
                'name'                  => 'required',
                'instrument_quantity'   => 'required',
                'description'           => 'string|nullable',
                'price'                 => 'required|numeric',
                'category_id'           => 'required|exists:categories,id',
                'image'                 => 'image|mimes:jpeg,png,jpg,gif', // Add image validation rules
                // Add any other validation rules you need
            ]);

            // Upload and store the image
            $imagePath = $request->file('image')->store('images/instruments', 'public');

            // Save the instrument with the image path
            $instrument = Instrument::create([
                'name'                      => $request->name,
                'instrument_quantity'       => $request->instrument_quantity,
                'description'               => $request->description,
                'price'                     => $request->price,
                'category_id'               => $request->category_id,
                'image'                     => $imagePath,
            ]);

            $log_entry = Auth::user()->name . " added a new instrument name: " . $instrument->name . " with the id# " . $instrument->id;
            event(new UserLog($log_entry));

            return redirect()->route('instruments.index')
                ->with('success', 'Instrument created successfully');
        // }catch (\Exception $e) {
        //     dd($e->getMessage());
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Instrument  $instrument
     * @return \Illuminate\Http\Response
     */
    public function show(Instrument $instrument)
    {
        return view('instruments.show', compact('instrument'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Instrument  $instrument
     * @return \Illuminate\Http\Response
     */
    public function edit(Instrument $instrument)
    {
        $categories = Category::all();
        return view('instruments.edit', compact('instrument', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Instrument  $instrument
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Instrument $instrument)
    {
        // try {
            // dd($request->all());
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'instrument_quantity' => 'required|numeric',
                'description' => 'nullable|string',
                'price' => 'required|numeric',
                'category_id' => 'required|exists:categories,id',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            ]);

            if ($validator->fails()) {
                // Display validation errors manually
                dd($validator->errors()->all());
            }

            // If a new image is uploaded, delete the old image and upload the new one
            if ($request->hasFile('image')) {
                Storage::disk('public')->delete($instrument->image);

                $imagePath = $request->file('image')->store('images/instruments', 'public');
            } else {
                // If no new image is uploaded, keep the existing image path
                $imagePath = $instrument->image;
            }

            // Update the instrument with the new data
            $instrument->update([
                'name' => $request->input('name'),
                'instrument_quantity' => $request->input('instrument_quantity'),
                'description' => $request->input('description'),
                'price' => $request->input('price'),
                'category_id' => $request->input('category_id'),
                'image' => $imagePath,
            ]);

            // dd($instrument);
            $log_entry = Auth::user()->name . " updated an instrument name: " . $instrument->name . " with the id# " . $instrument->id;
            event(new UserLog($log_entry));

            return redirect()->route('instruments.index')
                ->with('success', 'Instrument updated successfully');
        // }catch (\Exception $e) {
        //     dd($e->getMessage());
        // }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Instrument  $instrument
     * @return \Illuminate\Http\Response
     */
    public function destroy(Instrument $instrument)
    {
        $log_entry = Auth::user()->name . " deleted an instrument name: " . $instrument->name . " with the id# " . $instrument->id;
        event(new UserLog($log_entry));

        Storage::disk('public')->delete($instrument->image);
        $instrument->delete();

        return redirect()->route('instruments.index')
            ->with('success', 'Instrument deleted successfully');
    }
}

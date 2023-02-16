<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function index()  {
        $listings = Listing::latest()->filter(request(['tags', 'search']))->paginate(6);
        return view('listing.index', ['listings' => $listings]);
    }

    public function show($id)  {
        $listing = Listing::find($id);
        return view('listing.show', ['listing' => $listing]);
    }

    public function create() {
        return view('listing.create');
    }

    public function store(Request $request) {
        $fields = $request->validate([
            'title' => 'required',
            'company' => 'required|unique:listings',
            'location' => 'required',
            'website' => 'required',
            'email' => 'required|email',
            'tags' => 'required',
            'description' => 'required'
        ]); 

        if($request->hasFile('logo')) { 
            $fields['logo'] = $request->file('logo')->store('logos', 'public');
        } 

        $fields['user_id'] = auth()->id();
        Listing::create($fields);
        return redirect('/')->with('message', "Listing created successfully");
    }

    public function edit(Listing $listing) {
        return view('listing.edit', ['listing' => $listing]);
    }

    public function update(Request $request, Listing $listing) {
        $fields = $request->validate([
            'title' => 'required',
            'company' => 'required',
            'location' => 'required',
            'website' => 'required',
            'email' => 'required|email',
            'tags' => 'required',
            'description' => 'required'
        ]); 

        if($request->hasFile('logo')) { 
            $fields['logo'] = $request->file('logo')->store('logos', 'public');
        } 
        $listing->update($fields);
        return back()->with('message', "Listing updated successfully");
    }

    public function destroy(Listing $listing) {
        $listing->delete();
        return redirect('/')->with('message', 'Listing deleted successfully');
    }
}

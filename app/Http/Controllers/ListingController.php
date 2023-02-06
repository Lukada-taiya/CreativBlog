<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function index()  {
        $listings = Listing::latest()->filter(request(['tags', 'search']))->get();
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

        Listing::create($fields);
        return redirect('/')->with('message', "Listing created successfully");
    }
}

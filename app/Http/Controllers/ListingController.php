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
}

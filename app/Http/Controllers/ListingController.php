<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{

    public function listingShow() 
    {
        return Listing::latest()->filter(request(['tag', 'search']))->simplePaginate(6);
    }

    // Index
    public function index( Request $request )
    {
        // dd(request('tag'));
        return view('listings.index', [
            'items' => $this->listingShow()
        ]);
    }

    // Show
    public function show( Listing $listing )
    {
        return view('listings.show', [
            'item' => $listing
        ]);
    }

    // create
    public function create()
    {
        return view('listings.create');
    }

    // store
    public function store( Request $request )
    {
        // dd($request->file('logo'));

        $formFields = $request->validate([
            'title'       => 'required',
            // 'company'     => ['required', Rule::unique('listings', 'company')],
            'company'     => ['required'],
            'location'    => 'required',
            'website'     => 'required',
            'email'       => ['required', 'email'],
            'tags'        => 'required',
            'description' => 'required'
        ]);
        //Aigula Request dia validate kore nen controller er majhe aigula dile code onk boro hoye jabe 
        //https://laravel.com/docs/9.x/validation

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->id();

        Listing::create( $formFields );

        return redirect('/')->with('message', 'Listing create successfully!');
    }

    // edit
    public function edit( Listing $listing )
    {
        if (auth()->user()->id !== $listing->user_id)	 {
            return redirect('/');
        }
        return view('listings.edit', ['item' => $listing]);
    }

    // update
    public function update( Request $request, Listing $listing )
    {

        // make sure logged in user is owner
        if ($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $formFields = $request->validate([
            'title'       => 'required',
            // 'company'     => ['required', Rule::unique('listings', 'company')],
            'company'     => ['required'],
            'location'    => 'required',
            'website'     => 'required',
            'email'       => ['required', 'email'],
            'tags'        => 'required',
            'description' => 'required'
        ]);

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->id();

        $listing->update( $formFields );

        return back()->with('message', 'Listing update successfully!');
    }

    // delete listing
    public function destroy( Listing $listing )
    {
        // make sure logged in user is owner
        if ($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $listing->delete();

        return redirect('/')->with('message', 'Listing delete successfully!');
    }

    // manage
    public function manage()
    {
        return view('listings.manage', [
            'items' => auth()->user()->listings()->get()
        ]);
    }
}

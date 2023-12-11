<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

class ListingController extends Controller
{
    public function index()
    {
        $tag = request('tag');
        $search = request('search');
        
        return view('Listings.index', [
            'listings' => Listing::latest()
                ->when($tag, fn($query) => $query->filter(['tag' => $tag]))
                ->when($search, fn($query) => $query->filter(['search' => $search]))
                ->paginate(6)
        ]);
    }

    public function show(Listing $listing)
    {
        return view('listings.show', ['listing' => $listing]);
    }

    public function create()
    {
        return view('listings.create');
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required',
        ]);

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->id();
        Listing::create($formFields);

        // Uncomment the line below if you want to use flash messages
        // Session::flash('message', 'Job created successfully');

        return redirect('/')->with('message', 'Job created successfully');
    }

    public function edit(Listing $listing)
    {
        return view('listings.edit', ['listing' => $listing]);
    }

    public function update(Request $request, Listing $listing)
    {
        //make sure logged in user owner
        if($listing->user_id != auth()->id()){
            abort(403,'unauthorized action');
        }
        $formFields = $request->validate([
            
            
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required',
        ]);

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($formFields);

        // Uncomment the line below if you want to use flash messages
        // Session::flash('message', 'Job updated successfully');

        return back()->with('message', 'Job updated successfully');
    }

    public function delete(Listing $listing)
    {
        //make sure logged in user owner
        if($listing->user_id != auth()->id()){
            abort(403,'unauthorized action');
        }
        $listing->delete();
        return redirect('/')->with('message', 'Listing is deleted');
    }

    public function manage()
    {
        return view('Listings.manage', ['listings' => auth()->user()->listings()->get()]);
    }
}

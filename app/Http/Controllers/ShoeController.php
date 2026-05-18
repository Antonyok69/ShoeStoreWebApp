<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shoe;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth;
class ShoeController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function index()
{
    $shoes = Shoe::all();
    return view('shoes.index', compact('shoes'));
}


    public function create()
    {
        return view('Shoes.create');// Just a placeholder for testing
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $shoe = new Shoe([
            'name' => $request->name,
            'price' => $request->price,
            'category' => $request->category,
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $shoe->image = str_replace('public/', '', $imagePath);
        }

        $shoe->save();

        return redirect()->route('shoes.index');

    }
    public function show($id)
    {
        $shoe = Shoe::find($id);
    
        if (!$shoe) {
            return redirect()->route('shoes.index')->with('error', 'Shoe not found.');
        }
    
        return view('shoes.show', compact('shoe'));
    }
    public function about()
        {
                return view('FrontEnd.about') ;
        }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $shoe = Shoe::find($id);

        return view('shoes.edit', compact('shoe'));
    }
    public function ContactUs(){
        return view('FrontEnd.contactUs');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $shoe = Shoe::find($id);

        $shoe->name = $request->name;
        $shoe->price = $request->price;
        $shoe->category = $request->category;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $shoe->image = str_replace('public/', '', $imagePath);
        }

        $shoe->save();

        return redirect()->route('shoes.index')->with('success', 'Shoe updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $shoe = Shoe::find($id);

        if ($shoe->image) {
            Storage::delete('public/' . $shoe->image);
        }

        $shoe->delete();

        return redirect()->route('shoes.index')->with('success', 'Shoe deleted successfully.');
    }
   public function home()
{
    $mainShoes = Shoe::orderBy('id', 'desc')->get();

    if (Auth::user() && Auth::user()->is_admin) {
        return view('admin.adminHouse', compact('mainShoes'));
    } else {
        return view('FrontEnd.home', compact('mainShoes'));
    }
}


    public function search(Request $request)
{
    $query = $request->input('query');
    $menShoes = Shoe::where('name', 'like', "%{$query}%")->distinct()->get();

    return view('search-results', ['shoes' => $menShoes]);
}

public function men()
{
    $menShoes = Shoe::where('category', 'Men')
        ->orderBy('id', 'desc')
        ->get();

    if (Auth::user() && Auth::user()->is_admin) {
        return view('admin.adminMen', compact('menShoes'));
    } else {
        return view('MenWomen.men', compact('menShoes'));
    }
}
public function women()
{
    $womenShoes = Shoe::where('category', 'Women')
        ->orderBy('id', 'desc')
        ->get();

    if (Auth::user() && Auth::user()->is_admin) {
        return view('admin.adminWomen', compact('womenShoes'));
    } else {
        return view('MenWomen.women', compact('womenShoes'));
    }
}
}

<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tags = $request->get('keyword') ? Tag::search($request->keyword)->get() : Tag::all();
        // $tags = Tag::all();
        return view('tags.index', compact('tags'));
    }

    public function select(Request $request) {
        $tags = [];
        if ($request-> has('q')) {
            $tags = Tag::select('id', 'title')->search($request->q)->get();
        } else {
            $tags = Tag::select('id', 'title')->limit(5)->get();
        }

        return response()->json($tags);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Validator::make(
            $request->all(),
            [
                'title' => 'required|string|max:25',
                'slug' => 'required|string|unique:tags,slug'
            ],
        )->validate();

        try {
            Tag::create([
                'title' => $request->title,
                'slug' => $request->slug
            ]);

            Alert::success('Tambah Tag', 'Berhasil');

            return redirect()->route('tags.index');
        } catch (\Throwable $th) {
            Alert::error('Tambah Tag', 'Gagal');

            return redirect()->back()->withInput($request->all());

        }


    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        return view('tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        Validator::make(
            $request->all(),
            [
                'title' => 'required|string|max:25',
                'slug' => 'required|string|unique:tags,slug,' . $tag->id
            ],
        )->validate();

        try {
            $tag->update([
                'title' => $request->title,
                'slug' => $request->slug
            ]);

            Alert::success('Edit Tag', 'Berhasil');

            return redirect()->route('tags.index');
        } catch (\Throwable $th) {
            Alert::error('Edit Tag', 'Gagal');

            return redirect()->back()->withInput($request->all());

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        try {
            $tag->delete();

            Alert::success('Delete Tag', 'Berhasil');

        } catch (\Throwable $th) {
            Alert::error('Delete Tag', 'Gagal');

        }

        return redirect()->back();
    }
}

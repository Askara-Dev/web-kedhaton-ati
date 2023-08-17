<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $statusSelected = in_array($request->get('status'), ['publish', 'draft']) ? $request->get('status') : "publish";
        $posts = $statusSelected == "publish" ? Post::publish() : Post::draft();

        if ($request->get('keyword')) {
            $posts->search($request->get('keyword'));
        }

        return view('posts.index', [
            'posts' => $posts->get(),
            'statuses' => $this->statuses(),
            'statusSelected' => $statusSelected
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create', [
            'categories' => Category::with('descendants')->onlyParent()->get(),
            'statuses' => $this->statuses()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required|string|max:60',
                'slug' => 'required|string|unique:posts,slug',
                'thumbnail' => 'required',
                'description' => 'required|string|max:240',
                'content' => 'required',
                'category' => 'required',
                'tag' => 'required',
                'status' => 'required'
            ]
        );

        if ($validator->fails()) {
            if ($request['tag']) {
                $request['tag'] = Tag::select('id', 'title')->whereIn('id', $request->tag)->get();
            }
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        // store data
        DB::beginTransaction();

        try {
            $post = Post::create([
                'title' => $request->title,
                'slug' => $request->slug,
                'thumbnail' => parse_url($request->thumbnail)['path'],
                'description' => $request->description,
                'content' => $request->content,
                'status' => $request->status,
                'user_id' => Auth::user()->id,
            ]);

            // attach relation
            $post->tags()->attach($request->tag);
            $post->categories()->attach($request->category);

            // Sweet alert
            Alert::success('Tambah Post', 'Berhasil');

            return redirect()->route('posts.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            // sweet alert
            Alert::error('Tambah Post', 'Gagal');

            if ($request['tag']) {
                $request['tag'] = Tag::select('id', 'title')->whereIn('id', $request->tag)->get();
            }
            return redirect()->back()->withInput($request->all());
        } finally {
            DB::commit();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $categories = $post->categories;
        $tags = $post->tags;
        return view('posts.detail', compact('post', 'categories', 'tags'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('posts.edit', [
            'post' => $post,
            'categories' => Category::with('descendants')->onlyParent()->get(),
            'statuses' => $this->statuses()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required|string|max:60',
                'slug' => 'required|string|unique:posts,slug,' . $post->id,
                'thumbnail' => 'required',
                'description' => 'required|string|max:240',
                'content' => 'required',
                'category' => 'required',
                'tag' => 'required',
                'status' => 'required'
            ]
        );

        if ($validator->fails()) {
            if ($request['tag']) {
                $request['tag'] = Tag::select('id', 'title')->whereIn('id', $request->tag)->get();
            }
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        // update data
        DB::beginTransaction();

        try {
            $post->update([
                'title' => $request->title,
                'slug' => $request->slug,
                'thumbnail' => parse_url($request->thumbnail)['path'],
                'description' => $request->description,
                'content' => $request->content,
                'status' => $request->status,
                'user_id' => Auth::user()->id,
            ]);

            // attach relation
            $post->tags()->sync($request->tag);
            $post->categories()->sync($request->category);

            // Sweet alert
            Alert::success('Edit Post', 'Berhasil');

            return redirect()->route('posts.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            // sweet alert
            Alert::error('Edit Post', 'Gagal');

            if ($request['tag']) {
                $request['tag'] = Tag::select('id', 'title')->whereIn('id', $request->tag)->get();
            }
            return redirect()->back()->withInput($request->all());
        } finally {
            DB::commit();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // delete data
        DB::beginTransaction();

        try {

            $post->tags()->detach();
            $post->categories()->detach();
            $post->delete();


            // Sweet alert
            Alert::success('Delete Post', 'Berhasil');

            return redirect()->route('posts.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            // sweet alert
            Alert::error('Delete Post', 'Gagal');
        } finally {
            DB::commit();
            return redirect()->back();
        }
    }

    private function statuses()
    {
        return [
            'draft' => 'Draft',
            'publish' => 'Publish'
        ];
    }
}

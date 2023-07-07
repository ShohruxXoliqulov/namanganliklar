<?php

namespace App\Http\Controllers\Admin;

use App\Events\AuditEvent;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(10);

        

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories = Category::all();
      
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requestData = $request->all();

        if ($request->hasFile('img'))
        {
            $requestData['img'] = $this->img_upload();
        }
        Post::create($requestData);

        $user = auth()->user()->name;
        event(new AuditEvent($user, 'add', $request));
        return redirect()->route('admin.posts.index')->with('succes', 'Muvaffaqiyatli qo`shildi!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $categories = Category::all();

        return view('admin.posts.show', compact('categories', 'post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
      
        return view('admin.posts.update', compact('categories', 'post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $requestData = $request->all();

        if ($request->hasFile('img'))
        {
            if(isset($post->img) && file_exists(public_path('/files/'.$post->img))){
                unlink(public_path('/files/'.$post->img));
            }
            $requestData['img'] = $this->img_upload();
        }
        $post->update($requestData);

        return redirect()->route('admin.posts.index')->with('succes', 'Muvaffaqiyatli yangilandi!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if(isset($post->img) && file_exists(public_path('/files/'.$post->img))){
            unlink(public_path('/files/'.$post->img));
        }
        $post->delete();

        return redirect()->route('admin.posts.index')->with('succes', 'Muvaffaqiyatli o`chirildi!');
    }

    public function img_upload(){
        $file = request()->file('img');
        $fileName = time().'-'.$file->getClientOriginalName();
        $file->move('files/', $fileName);
        return $fileName;
    }

    // public function delete_img(){
    //     if(isset($post->img) && file_exists(public_path('/files/'.$post->img))){
    //         unlink(public_path('/files/'.$post->img));
    //     }
    // }
}

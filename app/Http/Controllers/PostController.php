<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    //All Posts
    public function index(){
        return view('posts.index',[
            'posts' => Post::latest()->filter(request(['tag','search']))->paginate(3)
        ]);
    }

    //Single Post
    public function show(Post $post){
        return view('posts.show',[
            'post' => $post
        ]);
    }
    //create post Form
    public function create(){
        return view('posts.create');
    }
    //Store post form
    public function store(Request $request){
        $formFields = $request->validate([
           'title' => 'required',
           'company' => ['required',Rule::unique('posts','company')],
           'location' => 'required',
           'email' => ['required','email'],
           'website' => 'required',
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos','public');
        }
        //relation with user
        $formFields['user_id'] = auth()->id();

        Post::create($formFields);

        return redirect('/')->with('message','Post successfully created');
    }

    //SHow Edit Form
    public function edit(Post $post){
        return view('posts.edit',[
           'post' => $post
        ]);
    }

    //Update the Edit form
    public function update(Request $request,Post $post)
    {
        //make sure logged in user is owner
        if( $post->user_id != auth()->id()){
            abort('403','Unauthorized Action');
        }

        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'email' => ['required', 'email'],
            'website' => 'required',
            'tags' => 'required',
            'description' => 'required'
        ]);
        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos','public');
        }
        $post->update($formFields);

        return back()->with('message','Post updated successfully');
    }

    //Delete Post
    public function destroy(Post $post){
        //make sure logged in user is owner
        if($post->user_id != auth()->id()){
            abort('403','Unauthorized Action!');
        }

        $post->delete();

        return redirect('/')->with('message','Post deleted successfully');
    }

    //Manage Posts
    public function manage(){
        return view('posts.manage', [
            'posts' => auth()->user()->posts()->get()
        ]);
    }

}

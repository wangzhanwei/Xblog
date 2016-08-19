<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests;
use App\Page;
use App\Post;
use App\Tag;
use App\User;
use DB;

class AdminController extends Controller
{
    //
    /**
     * AdminController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $info = [];
        $info['post_count'] = Post::withTrashed()->count();
        $info['user_count'] = User::count();
        $info['category_count'] = Category::count();
        $info['tag_count'] = Tag::count();
        $info['page_count'] = Page::count();

        return view('admin.index', compact('info'));
    }

    public function posts()
    {
        $posts = Post::withTrashed()->orderBy('created_at','desc')->get(['id', 'title', 'created_at', 'slug', 'deleted_at', 'published_at']);
        return view('admin.posts', compact('posts'));
    }

    public function tags()
    {
        $tags = Tag::all();
        return view('admin.tags', compact('tags'));
    }

    public function categories()
    {
        $categories = Category::all();
        return view('admin.categories', compact('categories'));
    }

    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function pages()
    {
        $pages = Page::all();
        return view('admin.pages', compact('pages'));
    }

}

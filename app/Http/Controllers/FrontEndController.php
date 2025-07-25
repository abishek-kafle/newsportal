<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Category;
use App\Models\Theme;
use Illuminate\Support\Facades\Session;

class FrontEndController extends Controller
{
    public function index(){
        $latest_news = News::latest()->where('status', 1)->take(3)->get();
        $news_latest = News::latest()->where('status', 1)->paginate(4);
        $theme = Theme::first();
        $categories = Category::where('status', 1)->where('parent_id', 0)->get();
        $categories_news_views = News::orderBy('view_count', 'DESC')->take(5)->get();
        $popular_posts = News::where('status', 1)->orderBy('view_count','DESC')->take(4)->get();
        $recent_posts = News::where('status', 1)->latest()->take(4)->get();
      return view('index', compact('latest_news', 'news_latest', 'categories', 'categories_news_views','popular_posts','recent_posts'));
    }

    public function newsSingle($slug){
        $news_detail = News::where('slug', $slug)->first();
        $theme = Theme::first();
        $newsKey = 'news_'.$news_detail->id;
        if(!Session::has($newsKey)){
            $news_detail->increment('view_count');
            Session::put($newsKey, 1);
        }

        $related_news = News::where('category_id', '=', $news_detail->category_id)->where('id','!=', $news_detail->id)->get();

        return view('newsSingle', compact('news_detail','theme', 'related_news'));
    }
}

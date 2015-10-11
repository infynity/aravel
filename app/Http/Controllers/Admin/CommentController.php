<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use Auth;

class CommentController extends Controller
{

    public function __construct()
    {
        view()->share(['_good' => 'am-in', '_comment' => 'am-active']);
    }

    public function index()
    {
        $comments = Comment::with('good', 'user')->orderBy('created_at', 'desc')->paginate(config('wyshop.page_size'));
        return view('admin.comment.index', ['comments' => $comments]);
    }

    public function show($id)
    {
        $admin = Auth::user();
        $comment = Comment::with('good', 'user')->find($id);
        return view('admin.comment.show', ['comment' => $comment, 'admin' => $admin]);
    }

    //管理员回复评论
    public function reply(Request $request, $id)
    {
        $admin = Auth::user();
        $comment = Comment::find($id);
        $comment->reply = $request->reply;
        $comment->admin_id=$admin->id;
        $comment->save();
        return back()->with('info', '回复成功');;
    }

    public function destroy($id)
    {
        Comment::destroy($id);
        return back()->with('info', '删除评论成功');
    }
}

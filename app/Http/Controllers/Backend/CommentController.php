<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Blog;
use Illuminate\Support\Carbon;

class CommentController extends Controller
{
    public function AllComment() {
        $comments = Comment::latest()->get();
        return view('admin.comment.comment_all', compact('comments'));
    }

    public function CommentView($id) {
        $comment = Comment::findOrFail($id);
        return view('admin.comment.comment_view', compact('comment'));
    }

    public function CommentDelete($id) {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        $notification = array(
            'message' => 'Comment Delete Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('comment.all')->with($notification);
    }

    // API
    public function CommentAll() {
        $comments = Comment::latest()->get();
        $results = $comments->slice(0, 4);
        return $results;
    }

    public function CommentStore(Request $request) {
        $owner = $request->input('owner');
        $content = $request->input('content');
        $blog_id = $request->input('blog_id');
        $email = $request->input('email');
        $phone = $request->input('phone');

        if ($request->input('comment_reply_id')) {
            $comment_reply_id = $request->input('comment_reply_id');
        } else {
            $comment_reply_id = null;
        }
        if ($request->input('target_name')) {
            $target_name = $request->input('target_name');
        } else {
            $target_name = null;
        }

        try {
            $comment = Comment::create([
                'owner' => $owner,
                'target_name' => $target_name,
                'content' => $content,
                'blog_id' => $blog_id,
                'email' => $email,
                'phone' => $phone,
                'comment_reply_id' => $comment_reply_id,
                'created_at' => Carbon::now()
            ]);

            return response([
                'message' => "Comment Posted Successfully!",
                'comment' => $comment
            ], 200);    // Success 200 code

        } catch(Exception $exception) {
            return response([
                'message' => $exception->getMessage()
            ], 400);
        }
    }

    public function CommentLike($id) {
        $comment = Comment::findOrFail($id);
        $like_count = $comment->like_count;
        $comment->update([
            'like_count' => $like_count + 1,
        ]);
        $blog_id = $comment->blog->id;
        $blog = Blog::with('category', 'comments.replies.replies')->findOrFail($blog_id);
        return response([
            'message' => "Liked This Comment",
            'blog' => $blog
        ], 200);    // Success 200 code
    }

    public function CommentUnLike($id) {
        $comment = Comment::findOrFail($id);
        $like_count = $comment->like_count;
        $comment->update([
            'like_count' => $like_count - 1,
        ]);
        $blog_id = $comment->blog->id;
        $blog = Blog::with('category', 'comments.replies.replies')->findOrFail($blog_id);
        return response([
            'message' => "Unliked This Comment",
            'blog' => $blog
        ], 200);    // Success 200 code
    }
}

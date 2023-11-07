<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use Intervention\Image\Facades\Image;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class BlogController extends Controller
{
    //
    public function AllBlogCategory()
    {
        $category = BlogCategory::latest()->get();

        return view('Backend.category.blog_category', compact('category'));
    }



    public function StoreBlogCategory(Request $request)
    {

        BlogCategory::insert([

            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
            'created_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'BlogCategory Create Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.blog.category')->with($notification);
    } // End Method 
    public function EditBlogCategory($id)
    {
        $categories = BlogCategory::findOrFail($id);
        return response()->json($categories);
    }



    public function DeleteBlogCategory($id)
    {

        $category = BlogCategory::findOrFail($id);

        BlogCategory::findOrFail($id)->delete();

        $notification = array(
            'message' => 'category Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // End Method  
    public function AllPost()
    {
        $post = BlogPost::latest()->get();
        return view('Backend.post.all_post', compact('post'));
    }

    public function AddPost()
    {
        $blogcat = BlogCategory::latest()->get();
        return view('backend.post.add_post', compact('blogcat'));
    }

    public function StorePost(Request $request)
    {

        $image = $request->file('post_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(370, 250)->save('upload/post/' . $name_gen);
        $save_url = 'upload/post/' . $name_gen;

        BlogPost::insert([
            'blogcat_id' => $request->blogcat_id,
            'post_title' => $request->post_title,
            'user_id' => $request->user_id,
            'post_image' => $save_url,
            'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)),
            'short_descp' => $request->short_descp,
            'long_descp' => $request->long_descp,
            'post_tags' => $request->post_tags,
            'created_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'post Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.post')->with($notification);
    } // End Method 
    public function EditPost($id)
    {

        $blogcat = BlogCategory::latest()->get();
        $post = BlogPost::findOrFail($id);
        return view('backend.post.edit_post', compact('post', 'blogcat'));
    } // End Method


    public function UpdatePost(Request $request)
    {

        $post_id = $request->id;

        if ($request->file('post_image')) {

            $image = $request->file('post_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(370, 250)->save('upload/post/' . $name_gen);
            $save_url = 'upload/post/' . $name_gen;

            BlogPost::findOrFail($post_id)->update([
                'blogcat_id' => $request->blogcat_id,
                'user_id' => Auth::user()->id,
                'post_title' => $request->post_title,
                'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)),
                'short_descp' => $request->short_descp,
                'long_descp' => $request->long_descp,
                'post_tags' => $request->post_tags,
                'post_image' => $save_url,
                'created_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'BlogPost Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.post')->with($notification);
        } else {

            BlogPost::findOrFail($post_id)->update([
                'blogcat_id' => $request->blogcat_id,
                'user_id' => Auth::user()->id,
                'post_title' => $request->post_title,
                'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)),
                'short_descp' => $request->short_descp,
                'long_descp' => $request->long_descp,
                'post_tags' => $request->post_tags,
                'created_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'BlogPost Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.post')->with($notification);
        } // end else 

    } // End Method 

    public function DeletePost($id)
    {

        $post = BlogPost::findOrFail($id);
        $img = $post->post_image;
        unlink($img);

        BlogPost::findOrFail($id)->delete();

        $notification = array(
            'message' => 'BlogPost Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // End Method
    public function BlogDetails($slug)
    {
        $blog = BlogPost::where('post_slug', $slug)->first();
        $tag = $blog->post_tags;
        $tags = explode(',', $tag);
        $comment = comment::where('post_id', $blog->id)->where('parent_id', null)->limit(5)->get();
        // $reply = comment::where('parent_id', 'id')->limit(5)->get();
        $category = BlogCategory::latest()->get();
        $dpost = BlogPost::latest()->limit(3)->get();


        return view('frontend.blog.blog_details', compact('blog', 'tags', 'category',  'dpost', 'comment'));
    }

    public function BlogCatList($id)
    {
        $blog = BlogPost::where('blogcat_id', $id)->paginate(5);
        $breadcat = BlogCategory::where('id', $id)->first();
        $bcategory = BlogCategory::latest()->get();
        $dpost = BlogPost::latest()->limit(3)->get();

        return view('frontend.blog.blog_cat_list', compact('blog', 'breadcat', 'bcategory',  'dpost'));
    }
    public function BlogList()
    {
        $blog = BlogPost::latest()->paginate(5);

        $bcategory = BlogCategory::latest()->get();
        $dpost = BlogPost::latest()->limit(3)->get();

        return view('frontend.blog.blog_list', compact('blog',  'bcategory',  'dpost'));
    }
    public function StoreComment(Request $request)
    {
        $pid = $request->post_id;

        comment::insert([
            'user_id' => Auth::user()->id,
            'post_id' => $pid,
            'parent_id' => null,
            'subject' => $request->subject,

            'message' => $request->message,
            'status' => '0',
            'created_at' => Carbon::now(),

        ]);
        $notification = array(
            'message' => 'comment will be shown after administrator confirmation',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function AdminBlogComment()
    {
        $comment = Comment::where('parent_id', null)->latest()->get();
        return view('backend.comment.comment_all', compact('comment'));
    }
    public function AdminCommentReply($id)
    {

        $comment = Comment::where('id', $id)->first();
        return view('backend.comment.comment_reply', compact('comment'));
    }
    public function ReplyMessage(Request $request)
    {
        $id = $request->id;
        $uid = $request->user_id;
        $pid = $request->post_id;
        comment::insert([
            'user_id' => $uid,
            'post_id' => $pid,
            'parent_id' => $id,
            'subject' => $request->subject,
            'message' => $request->message,
            'status' => '0',
            'created_at' => Carbon::now(),

        ]);
        $notification = array(
            'message' => 'reply added successfully!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}

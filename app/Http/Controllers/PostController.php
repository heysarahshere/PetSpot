<?php

namespace App\Http\Controllers;

use App\Alert;
use App\Comment;
use App\Notifications\CommentNotification;
use App\Notifications\CommentReplyNotification;
use App\Notifications\FoundPetAlert;
use App\Notifications\MessageAlert;
use App\Notifications\UserPetAlert;
use App\Post;
use App\Reply;
use App\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function getPosts() {
        $posts = Post::orderBy('created_at', 'desc')->paginate(24);
        return view('forum/all', [
            'posts' => $posts,
            'category' => "All",
            'page' => '',
            'animal' => '',
            'state' => ''
        ]);
    }

    public function getPostDetails($id) {
        $post = Post::find($id);
        $comments = Comment::where('parent_id', 0)->where('post_id', $id)->orderBy('created_at', 'desc')->paginate(8);

        return view('forum/details', [
            'post' => $post,
            'comments' => $comments
        ]);
    }

    public function getAddPost() {
//        $post = Post::find($id);
        return view('forum/new');
    }

    public function getGeneral()
    {
        $posts = Post::where('category', 'General')->orderBy('updated_at', 'desc')->paginate(24);
        return view('forum/all', [
            'posts' => $posts,
            'category' => "General",
            'page' => "General",
            'animal' => '',
            'state' => ''
        ]);
    }
    public function getSeeking()
    {
        $posts = Post::where('category', 'Seeking Pets')->orderBy('updated_at', 'desc')->paginate(24);
        return view('forum/all', ['posts' => $posts,
            'category' => "Seeking Pets",
            'page' => "Seeking Pets",
            'animal' => '',
            'state' => ''
            ]);
    }
    public function getLost()
    {
        $posts = Post::where('category', 'Lost Pets')->orderBy('updated_at', 'desc')->paginate(24);
        return view('forum/all', [
            'posts' => $posts,
            'category' => "Lost Pets",
            'page' => "Lost Pets",
            'animal' => '',
            'state' => ''
        ]);
    }

    public function getFound()
    {
        $posts = Post::where('category', 'Found Pets')->orderBy('updated_at', 'desc')->paginate(24);
        return view('forum/all', [
            'posts' => $posts,
            'category' => "Found Pets",
            'page' => "Found Pets",
            'animal' => '',
            'state' => ''
        ]);
    }

    public function getEditPost($id){
        $post = Post::find($id);
        return view('forum/edit', ['post' => $post]);
    }

    public function filterForum($state, $orderBy, $page, $animal){
        if($page != ''){
            $posts = Post::where('state', $state)->where('category', 'desc')->orderBy('updated_at', 'desc')->paginate(24);
        } else{
            $posts = Post::where('state', $state)->orderBy('updated_at', 'desc')->paginate(24);
        }
        return view('forum/all', ['posts' => $posts,'category' => "Found Pets", 'page' => "Found Pets"]);
    }

    public function byAnimal($animal, $orderBy, $page){
        $posts = Post::where('type', $animal)->orderBy('updated_at', 'desc')->paginate(24);
        return view('forum/all', ['posts' => $posts,'category' => "Found Pets", 'page' => "Found Pets"]);
    }

    public function byAnimalandState($animal, $state, $orderBy){
        $posts = Post::where('animal', $animal)->where('state', $state)->orderBy('updated_at', 'desc')->paginate(24);
        return view('forum/all', ['posts' => $posts,'category' => "Found Pets", 'page' => "Found Pets"]);
    }

    public function putEditPost(Request $request, $id){
        $this->validate($request, [
            'title' =>  'required|max:100',
            'content' =>  'required|max:5000',
            'category' =>  'required',
            'type' =>  'required',
            'event_date' =>  'required',
            'address_address' => 'required'
        ]);
        $post = Post::find($id);

        $user = Auth::user();
        $user_id = $user->id;
        $user_name = $user->userName;
        $email = $user->email;

        $content = $request['content'];
        $has_img = strpos($content, '<img ');


        if($has_img){
            preg_match('/<img[\d|\D]+\/>/', $content, $img_array);
            $post->img = $img_array[0];
        } else {
            $post->img = null;
        }

        $post->update([
            'title' =>  $request->input('title'),
            'contact_email' =>  $email,
            'content' =>  $request['content'],
            'category' =>  $request->input('category'),
            'user_id' =>   $user_id,
            'type' =>  $request->input('type'),
            'event_date' =>  $request->input('event_date'),
            'author' =>  $user_name,
        ]);

        $lat = $request->input('address_latitude');
        $lng = $request->input('address_longitude');

        if($lat != '0' && $lng != '0'){
            $post->address_address = $request->input('address_address');
            $post->address_latitude = $lat;
            $post->address_longitude = $lng;
        }

        $post->save();

        return redirect()->route('forum-details',['id' => $id])->with('message', 'Post updated.');
    }

    public function deletePost(Request $request){
        $id = $request->input('id');
        $post = Post::find($id);
        $post->delete();

        return redirect('forum/all');
    }

    public function deleteComment(Request $request){
        $id = $request->input('comment_id');
        $comment = Comment::find($id);
        $replies = Comment::where('parent_id', $id)->get();
        foreach ($replies as $reply){
            $reply->delete();
        }
        $comment->delete();

        return redirect()->back()->with('message', 'Comment deleted.');
    }

    public function postAddPost(Request $request){
        $this->validate($request, [
            'title' =>  'required|max:100',
            'content' =>  'required|max:5000',
            'category' =>  'required',
        ]);
        $user = Auth::user();
        $user_id = $user->id;
        $user_name = $user->userName;
        $email = $user->email;

        $content = $request['content'];
        $has_img = strpos($content, '<img ');
        $date = $request->input('event_date');
        $formatted_address = $request->input('address_address');
        $category = $request->input('category');
        if ($category === 'Found Pets' || $category === 'Lost Pets'){

            if (strpos($formatted_address, ', AL ') !== false) {
                $state = 'Alabama';
            } else if (strpos($formatted_address, ', AK ') !== false) {
                $state = 'Alaska';
            } else if (strpos($formatted_address, ', AZ ') !== false) {
                $state = 'Arizona';
            } else if (strpos($formatted_address, ', AK ') !== false) {
                $state = 'Arkansas';
            } else if (strpos($formatted_address, ', CA ') !== false) {
                $state = 'CALIFORNIA';
            } else if (strpos($formatted_address, ', CO ') !== false) {
                $state = 'Colorado';
            } else if (strpos($formatted_address, ', CT ') !== false) {
                $state = 'Connecticut';
            } else if (strpos($formatted_address, ', DE ') !== false) {
                $state = 'Delaware';
            } else if (strpos($formatted_address, ', FL ') !== false) {
                $state = 'Florida';
            } else if (strpos($formatted_address, ', GA ') !== false) {
                $state = 'Georgia';
            } else if (strpos($formatted_address, ', DE ') !== false) {
                $state = 'Delaware';
            } else if (strpos($formatted_address, ', HI ') !== false) {
                $state = 'Hawaii';
            } else if (strpos($formatted_address, ', ID ') !== false) {
                $state = 'Idaho';
            } else if (strpos($formatted_address, ', IL ') !== false) {
                $state = 'Illinois';
            } else if (strpos($formatted_address, ', IN ') !== false) {
                $state = 'Indiana';
            } else if (strpos($formatted_address, ', IA ') !== false) {
                $state = 'Iowa';
            } else if (strpos($formatted_address, ', KS ') !== false) {
                $state = 'Kansas';
            } else if (strpos($formatted_address, ', KY ') !== false) {
                $state = 'Kentucky';
            } else if (strpos($formatted_address, ', LA ') !== false) {
                $state = 'Louisiana';
            } else if (strpos($formatted_address, ', ME ') !== false) {
                $state = 'Maine';
            } else if (strpos($formatted_address, ', MD ') !== false) {
                $state = 'Maryland';
            } else if (strpos($formatted_address, ', MA ') !== false) {
                $state = 'Massachusetts';
            } else if (strpos($formatted_address, ', MI ') !== false) {
                $state = 'Michigan';
            } else if (strpos($formatted_address, ', MN ') !== false) {
                $state = 'Minnesota';
            } else if (strpos($formatted_address, ', MS ') !== false) {
                $state = 'Mississippi';
            } else if (strpos($formatted_address, ', MO ') !== false) {
                $state = 'Missouri';
            } else if (strpos($formatted_address, ', MT ') !== false) {
                $state = 'Montana';
            } else if (strpos($formatted_address, ', NE ') !== false) {
                $state = 'Nebraska';
            } else if (strpos($formatted_address, ', NV ') !== false) {
                $state = 'Nevada';
            } else if (strpos($formatted_address, ', NH ') !== false) {
                $state = 'New Hampshire';
            } else if (strpos($formatted_address, ', NJ ') !== false) {
                $state = 'New Jersey';
            } else if (strpos($formatted_address, ', NM ') !== false) {
                $state = 'New Mexico';
            } else if (strpos($formatted_address, ', NY ') !== false) {
                $state = 'New York';
            } else if (strpos($formatted_address, ', NC ') !== false) {
                $state = 'North Carolina';
            } else if (strpos($formatted_address, ', ND ') !== false) {
                $state = 'North Dakota';
            } else if (strpos($formatted_address, ', OH ') !== false) {
                $state = 'Ohio';
            } else if (strpos($formatted_address, ', OK ') !== false) {
                $state = 'Oklahoma';
            } else if (strpos($formatted_address, ', OR ') !== false) {
                $state = 'Oregon';
            } else if (strpos($formatted_address, ', PA ') !== false) {
                $state = 'Pennsylvania';
            } else if (strpos($formatted_address, ', RI ') !== false) {
                $state = 'Rhode Island';
            } else if (strpos($formatted_address, ', SC ') !== false) {
                $state = 'South Carolina';
            } else if (strpos($formatted_address, ', SD ') !== false) {
                $state = 'South Dakota';
            } else if (strpos($formatted_address, ', TN ') !== false) {
                $state = 'Tennessee';
            } else if (strpos($formatted_address, ', TX ') !== false) {
                $state = 'Texas';
            } else if (strpos($formatted_address, ', UT ') !== false) {
                $state = 'Utah';
            } else if (strpos($formatted_address, ', VT ') !== false) {
                $state = 'Vermont';
            } else if (strpos($formatted_address, ', VA ') !== false) {
                $state = 'Virginia';
            } else if (strpos($formatted_address, ', WA ') !== false) {
                $state = 'Washington';
            } else if (strpos($formatted_address, ', WV ') !== false) {
                $state = 'West Virginia';
            } else if (strpos($formatted_address, ', WI ') !== false) {
                $state = 'Wisconsin';
            } else if (strpos($formatted_address, ', WY ') !== false) {
                $state = 'Wyoming';
            } else {
                $state = 'Unknown';
            }
        } else { $state = null;}

        if($date){
            $date = date('Y-m-d', strtotime($date));
        } else { $date = date('Y-m-d');}

        $type = $request->input('type');
        if(!$type) {
            $type = 'other';
        }
        $post = new Post([
            'title' =>  $request->input('title'),
            'contact_email' =>  $email,
            'content' =>  $content,
            'category' =>  $category,
            'address_address' =>  $request->input('address_address'),
            'address_latitude' =>  $request->input('address_latitude'),
            'address_longitude' =>  $request->input('address_longitude'),
            'user_id' =>   $user_id,
            'author' =>  $user_name,
            'type' =>  $type,
            'state' =>  $state,
            'event_date' => $date
        ]);


        if($has_img){
            preg_match('/<img[\d|\D]+\/>/', $content, $img_array);
            $post->img = $img_array[0];
        }

        $post->save();
        $post_id = $post->id;

        if($category == 'Found Pets'){
            $alerts = Alert::where('type', $type)->where('state', $state)->get();

            foreach ($alerts as $alert) {
                // send alert to each user
                $user = Auth::user()->find($alert->user_id);
                // if user hasn't set up preferences
                $alert->notify(new FoundPetAlert($type, $state, $post_id));
                $user->notify(new UserPetAlert($type, $state, $post_id));
            }
        }
        return redirect()->route('forum-details',['id' => $post->id])
            ->with('message', 'Post added.');
    }

    public function postComment(Request $request){
        $this->validate($request, [
            'comment' =>  'required|max:800'
        ]);

        $post_id = $request->input('id');
        $post_id_count = $request->input('id');
        $poster_id = $request->input('poster_id');
        $comment = $request['comment'];

        $user = Auth::user();
        $user_id = $user->id;
        $user_img = $user->profile_image;
        $username = $user->userName;

        $comment = new Comment([
            'content' =>  $comment,
            'user_id' =>   $user_id,
            'username' =>   $username,
            'user_img' =>   $user_img,
            'post_id' =>   $post_id,
            'post_id_count' => $post_id_count,
            'parent_id' => 0
        ]);
        $comment->save();

        $post = Post::find($post_id);
        $poster = User::find($poster_id);

        if($user_id != $poster_id){
            if($poster){
                $poster->notify( new CommentNotification($post, $poster));
            }
            return redirect()->route('forum-details', [
                'post' => $post,
                'id' => $post_id
            ])->with('message', 'Comment added.');
        }else{
            return redirect()->route('forum-details', [
                'post' => $post,
                'id' => $post_id
            ])->with('message', 'Comment added.');
        }

    }

    public function postReply(Request $request){

        $this->validate($request, [
            'reply' =>  'required|max:800'
        ]);

        $parent_id = $request->input('parent_id');
        $parent_comment = Comment::find($parent_id);
        $parent_commenter_id = $parent_comment->user_id;
        $commenter = User::find($parent_commenter_id);

        $post_id = $request->input('post_id');
        $poster_id = $request->input('poster_id');
        $reply = $request['reply'];

        $user = Auth::user();
        $user_id = $user->id;
        $user_img = $user->profile_image;
        $username = $user->userName;

        $reply = new Comment([
            'content' =>  $reply,
            'user_id' =>   $user_id,
            'username' =>   $username,
            'user_img' =>   $user_img,
            'parent_id' =>   $parent_id,
            'post_id' => $post_id
        ]);
        $reply->save();

        $post = Post::find($post_id);
        $poster = User::find($poster_id);
        if($user_id != $poster_id){
            if($user_id != $parent_commenter_id){
                // notify parent commenter
                $commenter->notify( new CommentReplyNotification($post, $user));
            }
            if($poster){
                if($poster_id != $user_id){
                    $poster->notify( new CommentNotification($post, $user));
                }
            }

            return redirect()->route('forum-details', [
                'post' => $post,
                'id' => $post_id,
            ])->with('message', 'Comment added successfully.');

        } else {

            if($user_id != $parent_commenter_id){
                // notify parent commenter
                $commenter->notify( new CommentReplyNotification($post, $user));
            }
            return redirect()->route('forum-details', [
                'post' => $post,
                'id' => $post_id,
            ])->with('message', 'Comment added successfully.');
        }


    }

    public function search(Request $request) {

        $search_category = $request->input('search_category');
            $q = $request->input('q');
            $state = $request->input('state');
//            $orderBy = $request->input('orderBy');

          if ($search_category === 'Lost Pets' || $search_category === 'Seeking Pets' || $search_category === 'Found Pets' || $search_category === 'General' ){
                    $posts = Post::where('category' , $search_category)
                    ->where('title','LIKE','%'.$q.'%')
                    ->orWhere('content','LIKE','%'.$q.'%')
                    ->orWhere('author','LIKE','%'.$q.'%')
                    ->orWhere('address_address','LIKE','%'.$q.'%')
//                    ->where('state', $state)
                    ->orderBy('created_at', 'desc')
                    ->paginate(24);
                    $page = $search_category;
              $narrowed_search = $search_category;
            } else { $posts = Post::where('title','LIKE','%'.$q.'%')
                ->orWhere('category','LIKE','%'.$q.'%')
                ->orWhere('content','LIKE','%'.$q.'%')
                ->orWhere('author','LIKE','%'.$q.'%')
                ->orWhere('address_address','LIKE','%'.$q.'%')
//                ->where('state', $state)
                ->orderBy('created_at', 'desc')
                ->paginate(24);
            $page = '';
              $narrowed_search = null;
          }


        return view('forum/all', ['posts' => $posts, 'q' => $q, 'category' => 'Results for: '.$q , 'narrowed_search' => $narrowed_search, 'page' => $page])
            ->with('message', 'Results for: '.$q);
    }

    public function getMyPosts(){
        if(Auth::check()){
            $user_id = Auth::user()->id;
            $posts = Post::where('user_id','LIKE', $user_id)->paginate(8);

            return view('forum/all', ['posts' => $posts, 'category' => "My Posts", 'page' => '' ]);
        }
        redirect()->back()->with('error', 'Please log in to see your posts.');
    }

    public function getUserPosts($id){
        $user = User::find($id);
        if($user){
            $posts = Post::where('user_id','LIKE', $id)->paginate(24);
            $viewing_string = $user->userName."'s posts";

            return view('forum/all', ['posts' => $posts, 'category' => $viewing_string, 'page' => ''  ]);
        }
        redirect()->back()->with('error', 'That user could not be found.');
    }

    public function getMap(){
        $posts = Post::all();
        return view('forum/map', ['posts' => $posts, 'category' => "All Post Locations" ]);
    }
    public function getLostMap(){
        $posts = Post::where('category','LIKE', "Lost Pets")->get();
        return view('forum/map', ['posts' => $posts, 'category' => "Lost Pets Locations" ]);
    }
    public function getFoundMap(){
        $posts = Post::where('category','LIKE', "Found Pets")->get();
        return view('forum/map', ['posts' => $posts, 'category' => "Found Pets Locations" ]);
    }
    public function getSeekingMap(){
        $posts = Post::where('category','LIKE', "Seeking Pets")->get();
        return view('forum/map', ['posts' => $posts, 'category' => "Seeking Pets Locations" ]);
    }
    public function getSpecificMap($id){
        $post = Post::find($id);
        return view('forum/show-post', ['post' => $post, 'category' => "Post Location" ]);
    }

}

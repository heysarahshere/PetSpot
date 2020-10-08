<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Message;
use App\MessageThread;
use App\Notifications\ContactMessage;
use App\Notifications\MessageAlert;
use App\Notifications\ReportedPost;
use App\Notifications\UserReported;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Alert;

class AlertController extends Controller
{
    public function getNewAlert()
    {
        return view('alert/new');
    }

    // alert card crud
    public function postNewAlert(Request $request)
    {
        $this->validate($request, [
            'type' => 'required',
            'state' => 'required',
            'email' => 'required'
        ]);
        $type = $request->input('type');


        if (Auth::check()) {
            $user = Auth::user();

            if (count($user->alerts) < 12) {
                $alert = new Alert([
//                lowercase in actual use
                    'type' => $type,
                    'state' => $request->input('state'),
                    'email' => $request->input('email'),
                    'user_id' => $user->id
                ]);

                if ($type === 'Cat') {
                    $alert->img = 'cat-alert.png';

                } else if ($type === 'Dog') {
                    $alert->img = 'dog-alert.png';
                } else if ($type === 'Bird') {
                    $alert->img = 'bird-alert.png';
                } else {
                    $alert->img = 'other-alert.png';
                }
                $alert->save();

                return redirect()->back()->with('message', 'Found Pet Alert created. To manage your alerts, visit Profile > Active Pet Alerts.');
            } else {
                return redirect()->back()->with('message', 'You have reached the maximum allowed active alerts.');
            }


        } else {
            return redirect()->back()->with('message', 'Please log in or sign up to create alerts.');
        }
    }

    public function updateAlert(Request $request)
    {
        $this->validate($request, [
            'alert_type' => 'required',
            'alert_state' => 'required',
            'alert_email' => 'required'
        ]);
        $id = $request->input('alert_hidden_id');
        $type = $request->input('alert_type');
        if (Auth::check()) {
            $user = Auth::user();
            $alert = Alert::find($id);
            $alert->update([
//                lowercase in actual use
                'type' => $type,
                'state' => $request->input('alert_state'),
                'email' => $request->input('alert_email'),
                'user_id' => $user->id
            ]);

            if ($type === 'Cat') {
                $alert->img = 'cat-alert.png';

            } else if ($type === 'Dog') {
                $alert->img = 'dog-alert.png';
            } else if ($type === 'Bird') {
                $alert->img = 'bird-alert.png';
            } else {
                $alert->img = 'other-alert.png';
            }
            $alert->save();

            return redirect()->back()->with('message', 'Found Pet Alert updated.');
        } else {
            return redirect()->back()->with('message', 'Please log in to update your alerts.');
        }
    }

    public function deleteAlert(Request $request)
    {
        $id = $request->input('alert_id');

        $alert = Alert::find($id);
        if ($alert) {
            $alert->delete();
            return redirect()->back()->with('message', 'Alert deleted.');
        } else {
            return redirect()->back()->with('message', 'Alert does not exist.');
        }
    }

    //messages
    public function getInbox()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $in_message_threads = MessageThread::where('receiver_id', $user->id)
                ->with('sender')
                ->with('receiver')
                ->where('receiver_deleted', 0)
                ->orderBy('created_at', 'desc')
                ->get();
            $out_message_threads = MessageThread::where('sender_id', $user->id)
                ->with('sender')
                ->with('receiver')
                ->where('sender_deleted', 0)
                ->orderBy('created_at', 'desc')
                ->get();
            $alerts = Alert::where('user_id', Auth::user()->id)->get();
//            $notifications = $user->alerts();
            return view('user/inbox')->with([
                'alerts' => $alerts,
                'in_message_threads' => $in_message_threads,
                'out_message_threads' => $out_message_threads,
                'sent_count' => count($out_message_threads),
                'received_count' => count($in_message_threads)
            ]);
        } else {
            return redirect()->route('login')->with('message', 'You must be logged in to do that.');
        }
    }

    public function getThread($id)
    {
        if (Auth::check()) {
            $thread = MessageThread::find($id);
            if ($thread) {
                if (Auth::user()->id === $thread->sender_id) {
                    $messages = Message::where('thread_id', $id)->where('sender_deleted', 0)->orderBy('created_at', 'asc')->paginate(20);
                    $alerts = Alert::where('user_id', Auth::user()->id)->get();
                    return view('user/message')->with([
//                    'alerts' => $alerts,
                        'messages' => $messages,
                        'thread' => $thread
                    ]);
                } else if (Auth::user()->id === $thread->receiver_id) {
                    $messages = Message::where('thread_id', $id)->where('receiver_deleted', 0)->orderBy('created_at', 'asc')->paginate(20);
                    $alerts = Alert::where('user_id', Auth::user()->id)->get();
                    return view('user/message')->with([
//                    'alerts' => $alerts,
                        'messages' => $messages,
                        'thread' => $thread
                    ]);
                } else {
                    return redirect()->route()->back()->with('message', 'Error loading messages.');
                }

            } else {
                return redirect()->route('index')->with('message', 'You don\'t have access to that conversation.');
            }
        } else {
            return redirect()->route('login')->with('message', 'You must be logged in to do that.');
        }

    }

    public function postReply(Request $request)
    {
        if (Auth::user()) {
            $user = Auth::user();
            $reply = $request->input('reply');
            $thread_id = $request->input('thread_id');
            $thread = MessageThread::find($thread_id);
            if ($user->id === $thread->sender_id) {
                $receiver = User::find($thread->receiver_id);

            } else {
                $receiver = User::find($thread->sender_id);
            }
            $message = new Message([
                'user_id' => $user->id,
                'message' => $reply,
                'thread_id' => $thread->id
            ]);
            $message->save();

            $receiver->notify(new MessageAlert($thread, $user));

            event(new MessageSent($receiver));
            return redirect()->back()->with('message', 'Reply sent.');
        }
    }

    public function sendMessage(Request $request)
    {
        $recipient_id = $request->input('receiver_id');
        $subject = $request->input('subject');
        $content = $request->input('content');
        $sender = Auth::user();

        if (Auth::check()) {
            $thread = new MessageThread([
                'subject' => $subject,
                'receiver_id' => $recipient_id,
                'sender_id' => $sender->id
            ]);
            $thread->save();

            $message = new Message([
                'user_id' => $sender->id,
                'message' => $content,
                'thread_id' => $thread->id
            ]);
            $message->save();
            $recipient = User::find($recipient_id);
            $recipient->notify(new MessageAlert($thread, $sender));
            event(new MessageSent($recipient));

            return redirect()->back()->with('message', 'Message sent.');
        } else {
            return redirect()->back()->with('message', 'Something went wrong. Please try again later.');
        }
    }

    public function sendContactMessage(Request $request)
    {
        $this->validate($request, [
            'subject' => 'required',
            'name' => 'required',
            'email' => 'required',
            'reason' => 'required',
        ]);
        $recipient_id = $request->input('receiver_id');
        $subject = $request->input('subject');
        $content = $request->input('content');
        $name = $request->input('name');
        $email = $request->input('email');
        $reason = $request->input('reason');
        $sender = Auth::user();
        // make send email to admins
        $admins = User::where('admin', 1)->get();
        foreach ($admins as $admin) {
            $admin->notify(new ContactMessage($email, $reason, $name, $subject, $content));
        }
            return redirect()->back()->with('message', 'Message sent. Please allow up to 24 business hours for response.');
    }

    public function markMessageDeleted(Request $request)
    {
        if (Auth::check()) {
            $thread_id = $request->input('thread_id');
            $message_id = $request->input('message_id');
            $thread = MessageThread::find($thread_id);
            $message = Message::find($message_id);

            if (Auth::user()->id == $thread->sender_id) {
                $message->update(['sender_deleted' => 1]);
                if ($message->receiver_deleted == 1) {
                    $message->delete();
                }
                return redirect()->back()->with([
                    'message', 'Message deleted.'
                ]);
            } else if (Auth::user()->id == $thread->receiver_id) {
                $message->update(['receiver_deleted' => 1]);
                if ($message->sender_deleted == 1) {
                    $message->delete();
                }
                return redirect()->back()->with([
                    'message', 'Message deleted.'
                ]);
            } else {
                return redirect()->back()->with([
                    'message', 'There was a problem deleting the message.'
                ]);
            }
        }
    }

    public function markThreadDeleted(Request $request)
    {
        $id = $request->input('id');
        $thread = MessageThread::find($id);
        $user_id = Auth::user()->id;
        if(auth::check()){
            if ($thread) {
                if ($user_id === $thread->sender_id) {
                    $thread->update(['sender_deleted' => true]);
                    $thread->save();
                } else if ($user_id === $thread->receiver_id){
                    $thread->update(['receiver_deleted' => true]);
                    $thread->save();
                }
                if($thread->sender_deleted === true && $thread->receiver_deleted === true){
                    $messages = Message::where('thread_id', $id)->get();
                    foreach ($messages as $message) {
                        $message->delete();
                    }
                    $thread->delete();
                    return redirect()->route('inbox')->with('message', 'Message thread deleted.');
                } else {
                    return redirect()->route('inbox')->with('message', 'Messages deleted for you, but will still show up for the other party.');
                }
            }
            return redirect()->back()->with('message', 'That message thread wasn\'t found.');
        }
        return redirect()->route('login')->with('message', 'You must be logged in to do that.');
    }

    public function deleteSentMessages(Request $request){
        if(Auth::check()){
            $user_id = Auth::user()->id;
            $messages = MessageThread::where('sender_id', $user_id)->get();
            if($messages){
                foreach ($messages as $message) {
                    if($message->receiver_deleted === true){
                        $message->delete();
                    } else {
                        $message->update(['sender_deleted' => true]);
                        $message->save();
                    }
                }
            } else {
                return redirect()->back()->with('message', 'No sent messages found.');
            }
        }
        return redirect()->route('login')->with('message', 'You must be logged in to do that.');
    }

    public function deleteReceivedMessages(Request $request){
        if(Auth::check()){
            $user_id = Auth::user()->id;
            $messages = MessageThread::where('receiver_id', $user_id)->get();
            if($messages){
                foreach ($messages as $message) {
                    if($message->sender_deleted === true){
                        $message->delete();
                    } else {
                        $message->update(['receiver_deleted' => true]);
                        $message->save();
                    }
                }
            } else {
                return redirect()->back()->with('message', 'No sent messages found.');
            }
        }
        return redirect()->route('login')->with('message', 'You must be logged in to do that.');
    }

    public function sendReport(Request $request)
    {
        $id = $request->input('post_id');
        $reason = $request->input('reason');
        $other = $request->input('other');
        $post = Post::find($id);
        if($post){
            $admins = User::where('admin', 1)->get();
            foreach ($admins as $admin) {
                $admin->notify(new ReportedPost($post, $reason, $other));
            }
            return redirect()->back()->with('message', 'Thank you, the post has been reported.
             Moderators will resolve the issue as soon as possible.');
        }
        return redirect()->back()->with('message', 'That post couldn\'t be found.');
    }

    public function sendUserReport(Request $request)
    {
        $id = $request->input('user_id');
        $reason = $request->input('reason');
        $other = $request->input('other');
        $user = User::find($id);
        if($user){
            $admins = User::where('admin', 1)->get();
            foreach ($admins as $admin) {
                $admin->notify(new UserReported($user, $reason, $other));
            }
            return redirect()->back()->with('message', 'Thank you, the user has been reported.
             Moderators will resolve the issue as soon as possible.');
        }
        return redirect()->back()->with('message', 'There was a problem reporting that user.');
    }

    public function getNotifications()
    {
        if (Auth::check()) {
            $user = Auth::user();

//            $alerts = Alert::where('user_id', Auth::user()->id)->get();
            $unread_messages = $user->unreadnotifications->where('type', 'App\Notifications\MessageAlert')->all();
            $alerts = $user->unreadnotifications->where('type', 'App\Notifications\UserPetAlert')->all();
            $comments = $user->unreadnotifications->where('type', 'App\Notifications\CommentNotification')->all();
            $reports = $user->unreadnotifications->where('type', 'App\Notifications\ReportedPost')->all();
            $requests = $user->unreadnotifications->where('type', 'App\Notifications\ContactMessage')->all();
            $reported_users = $user->unreadnotifications->where('type', 'App\Notifications\UserReported')->all();

            return view('user/notifications')->with([
                'unread_messages' => $unread_messages,
                'alerts' => $alerts,
                'comments' => $comments,
                'reports' => $reports,
                'requests' => $requests,
                'user_reports' => $reported_users,
                'alert_count' => count($alerts),
                'message_count' => count($unread_messages),
                'comment_count' => count($comments),
                'report_count' => count($reports),
                'request_count' => count($requests),
                'user_report_count' => count($reported_users),
            ]);
        } else {
            return redirect()->route('login')->with('message', 'You must be logged in to do that.');
        }
    }

    // do something with read notifications
    public function markReadNotifications(Request $request)
    {
        if (Auth::check()) {
            $id = $request->input('notif_id');
            $user = Auth::user();
            $user->unreadNotifications()->where('id', $id)->update(['read_at' => now()]);
            return redirect()->back();
        } else {
            return redirect()->back()->with('message', 'You must be logged in for that.');
        }
    }

    public function markAllReadNotification()
    {
        if (Auth::check()) {
            Auth::user()->unreadNotifications->markAsRead();
            return redirect()->back()->with('message', 'Notifications cleared.');
        } else {
            return redirect()->back()->with('message', 'You must be logged in for that.');
        }

    }

    public function markReadFromLink($read)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $notification = $user->unreadnotifications->find($read);
            if ($notification->type === 'App\Notifications\CommentReplyNotification') {
                $id = $notification->data['post']['id'];
                $post = Post::find($id);
                return redirect()->route('forum-details', [
                    'post' => $post,
                    'id' => $id,
                    'read' => $notification->id
                ]);

            } else if ($notification->type === 'App\Notifications\CommentNotification') {
                $id = $notification->data['post']['id'];
                $post = Post::find($id);
                return redirect()->route('forum-details', [
                    'post' => $post,
                    'id' => $id,
                    'read' => $notification->id
                ]);

            } else if ($notification->type === 'App\Notifications\MessageAlert') {
                $id = $notification->data['thread']['id'];
                return redirect()->route('get-message', [
                    'id' => $id,
                    'read' => $notification->id
                ]);
            } else if ($notification->type === 'App\Notifications\FoundPetAlert') {
                $id = $notification->data['post_id'];
                return redirect()->route('forum-details', [
                    'id' => $id,
                    'read' => $notification->id
                ]);
            } else if ($notification->type === 'App\Notifications\ReportedPost') {
                $id = $notification->data['post']['id'];

                return redirect()->route('forum-details', [
                    'id' => $id,
                    'read' => $notification->id
                ]);
            } else if ($notification->type === 'App\Notifications\UserReported') {
                $username = $notification->data['user']['userName'];
                return redirect()->route('public-profile', [
                    'username' => $username,
                    'read' => $notification->id
                ]);
            } else {
                return redirect()->route('login')->with('message', 'Error: Notification not found.');
            }
        } else {
            return redirect()->route('login')->with('message', 'You must be logged in to do that.');
        }
    }
}

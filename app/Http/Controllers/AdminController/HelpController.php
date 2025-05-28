<?php

namespace App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use App\Models\Help;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class HelpController extends Controller
{
    //
    public function index()
    {
        $helps = Help::get()->where('status', 0);
        return view('admin.help', compact('helps'));
    }
    public function showReplyForm($id)
    {
        $help = Help::findOrFail($id);
        return view('admin.help_reply', compact('help'));
    }

    public function sendReply(Request $request, $id)
    {
        $help = Help::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',    // Tiêu đề (subject)
            'content' => 'required|string',          // Nội dung (body)
        ]);

        Mail::raw($request->content, function ($mail) use ($help, $request) {
            $mail->to($help->email)
                ->subject($request->title);  // Dùng title làm subject
        });
        $help->status = 1;
        $help->save();

        return redirect()->route('help.replyForm', $id)->with('success', 'Gửi phản hồi thành công!');
    }


}

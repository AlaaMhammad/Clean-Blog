<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ContactReply;
use App\Models\Contact;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    function index()
    {
        return view('dashboard.index');
    }

    function settings()
    {
        $settings = Setting::select('key', 'value')->get()->toArray();
        $new_settings = [];
        foreach ($settings as $setting) {
            $new_settings[$setting['key']] = $setting['value'];
        }
        $settings = $new_settings;
        return view('dashboard.settings', compact('settings'));
    }

    function settings_save(Request $request)
    {
        $data = $request->except('_token', '_method' . 'site_logo');
        if ($request->hasFile('site_logo')) {
            $data['site_logo'] = $request->file('site_logo')->store('uploads','custom');
        }

        foreach ($data as $key => $value) {
            Setting::updateorCreate([
                'key' => $key
            ],[
                    'value' => $value
                ]);
        }

        flash()->success('Settings Saved successfully');
        return redirect()->back();
    }

    function contact_messages()
    {
        $messages = Contact::latest()->get();
        return view('dashboard.messages.contact_messages', compact('messages'));
    }

    function contact_messages_show($id)
    {
        $message = Contact::findOrFail($id);
        $message->update([
            'is_open' => true
        ]);
        return view('dashboard.messages.contact_message_show', compact('message'));
    }

    function contact_messages_reply(Request $request ,$id)
    {
        $message = Contact::findOrFail($id);

        Mail::to($message->email)->send(new ContactReply($message->name ,$request->reply));

        flash()->success('Reply Message send successfully');
        return redirect()->back();
    }

    // function contact_messages_destroy($id)
    // {
    //     // $message = Contact::findOrFail($id);
    //     // return view('dashboard.contact_messages_show', compact('message'));
    // }

    function profile()
    {
        $user = Auth::user();
        return view('dashboard.profile', compact('user'));
    }

    function profile_save(Request $request )
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'password' => 'nullable|min:8|confirmed',
            'avatar' => 'nullable||image|mimes:png,jpg,svg,jpeg',
        ]);

        $data = $request->except(['token', '_method', 'avatar', 'password', 'password_confirmation']);

        if($request->password)
        {
            $data['password'] = $request->password;
        }

        if($request->hasFile('avatar'))
        {
            $data['avatar'] = $request->file('avatar')->store('uploads', 'custom');
        }

        /** @var App/Models/User $user */
        
        $user = Auth::user();
        $user->update([$data]);

        return redirect()->back();
    }

    function delete_site_logo(Request $request)
    {

        Artisan::call('cache:clear');
        Setting::where('key', 'site_logo')->update([
            'value' => null
        ]);
    
        return response()->json(['message' => 'Site Logo Deleted successfully']);
    }
}

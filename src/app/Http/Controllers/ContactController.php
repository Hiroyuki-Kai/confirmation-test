<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('contact.index', compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {
        $data = $request->all();

        $gender_list = [
            1 => '男性',
            2 => '女性',
            3 => 'その他'
        ];

        $data['gender_label'] = $gender_list[$data['gender']];

        $category = Category::find($data['category_id']);
        $data['category_name'] = $category->content;

        return view('contact.confirm', ['contact' => $data]);
    }

    public function revise(Request $request)
    {
        return redirect()->route('contact.index')->withInput($request->all());
    }

    public function store(Request $request)
    {
        Contact::create([
            'category_id' => $request->category_id,
            'first_name'  => $request->first_name,
            'last_name'   => $request->last_name,
            'gender'      => $request->gender,
            'email'       => $request->email,
            'tel'         => $request->tel1 . '-' . $request->tel2 . '-' . $request->tel3,
            'address'     => $request->address,
            'building'    => $request->building,
            'detail'      => $request->content,
        ]);

        // 二重送信防止のため POST → GET
        return redirect()->route('contact.thanks');
    }

    public function thanks()
    {
        return view('contact.thanks');
    }

}

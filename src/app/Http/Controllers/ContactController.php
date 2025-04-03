<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\Category;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;


class ContactController extends Controller
{
  public function input()
  {
    $todos = Todo::with('category')->get(); // Todoデータを取得
    $categories = Category::all(); // Categoryデータを取得

    // セッションからデータを取得（ない場合は空の配列）
    $contact = session('contact', []);

    // ビューにデータを渡す
    return view('input', compact('todos', 'categories', 'contact'));
  }

  public function confirm(ContactRequest $request)
  {
        $contact = $request->only(['first_name', 'last_name', 'gender', 'email', 'phone1', 'phone2', 'phone3', 'address', 'building', 'category_id', 'detail']);
        // 電話番号を結合して 'tell' フィールドに格納
        $contact['tell'] = $contact['phone1'] . $contact['phone2'] . $contact['phone3'];
        // データをセッションに保存
        $request->session()->put('contact', $contact);
        return view('confirm', compact('contact'));
  }

  public function store(ContactRequest $request)
  {
   $contact = $request->only(['first_name', 'last_name', 'gender', 'email', 'phone1', 'phone2', 'phone3', 'address', 'building', 'category_id', 'detail']);
   // 電話番号を結合して 'tell' フィールドに格納
    $contact['tell'] = $contact['phone1'] . $contact['phone2'] . $contact['phone3'];
   Contact::create($contact);
   $request->session()->forget('contact');
   return redirect()->route('thanks');
  }

  public function destroy(Request $request)
{
    // リクエストからIDを取得
    $contact = Contact::findOrFail($request->id);

    // 削除
    $contact->delete();

    // 削除後、リダイレクトしてメッセージを表示
    return redirect('/admin')->with('message', '削除が成功しました');
}
}
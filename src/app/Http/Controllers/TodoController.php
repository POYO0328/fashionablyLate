<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use App\Models\Category;
use App\Models\Contact;
use Illuminate\Http\Request;

class TodoController extends Controller
{
  public function index()
  {
    // Contactのデータを取得
    $contacts = Contact::Paginate(7);

    // Categoryのデータも取得
    $categories = Category::all();

    // ビューにcontactsとcategoriesを渡す
    return view('index', compact('contacts', 'categories'));
  }

  public function store(TodoRequest $request)
  {
    $todo = $request->only(['category_id', 'content']);
    Todo::create($todo);

    return redirect('/')->with('message', 'Todoを作成しました');
  }

  public function update(TodoRequest $request)
  {
    $todo = $request->only(['content']);
    Todo::find($request->id)->update($todo);

    return redirect('/')->with('message', 'Todoを更新しました');
  }

  public function destroy(Request $request)
  {
    Todo::find($request->id)->delete();

    return redirect('/')->with('message', 'Todoを削除しました');
  }

  public function search(Request $request)
  {
    // リクエストから検索条件を取得
    $keyword = $request->input('keyword');
    $category_id = $request->input('category_id');
    $gender = $request->input('gender'); 
    $created_at = $request->input('created_at');

    // クエリを条件に基づいてフィルタリング
    $contacts = Contact::query();

    // キーワード検索
    if ($keyword) {
        $contacts = $contacts->where('first_name', 'like', "%{$keyword}%")
                             ->orWhere('last_name', 'like', "%{$keyword}%")
                             ->orWhere('email', 'like', "%{$keyword}%");
    }

    // カテゴリ検索
    if ($category_id) {
        $contacts = $contacts->where('category_id', $category_id);
    }

    // 性別検索
    if ($gender) {
        $contacts = $contacts->where('gender', $gender);
    }

    // 日付検索
    if ($created_at) {
        $contacts = $contacts->whereDate('created_at', $created_at); // created_atの日付で検索
    }

    // 検索結果を取得
    $contacts = $contacts->Paginate(7);

    // カテゴリもビューに渡す
    $categories = Category::all();

    // ビューにデータを渡す
    return view('index', compact('contacts', 'categories'));
  }

public function login()
  {
  return view('auth.login');
  }
}

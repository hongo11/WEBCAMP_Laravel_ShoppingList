<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\CompletedShoppingList as CompletedShoppingListModel;
use Illuminate\Pagination\Paginator;

class CompletedShoppingListController extends Controller
{
    protected function getListBuilder()
{
    return CompletedShoppingListModel::where('user_id', Auth::id())
        ->orderBy('created_at', 'asc') // 日付が古い順に並び替え
        ->orderBy('name'); // もし日付が同じ場合は名前順に並び替え（オプション）
}
    public function list()
    {
        $completedTasks = $this->getListBuilder()
                              ->paginate(10);
        return view('task.completed_list', compact('completedTasks'));
    }
}

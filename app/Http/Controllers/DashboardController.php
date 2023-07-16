<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Deal;
use App\Models\Document;
use App\Models\Item;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $usersCount = User::count();
        $contactsCount = Contact::count();
        $itemsCount = Item::count();
        $dealsCount = Deal::count();
        $documentsCount = Document::count();
        $tasksCount = Task::count();

        return view('dashboard', compact('usersCount', 'contactsCount', 'itemsCount', 'dealsCount', 'documentsCount', 'tasksCount'));
    }
}

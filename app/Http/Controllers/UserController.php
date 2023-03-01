<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;

use Barryvdh\DomPDF\Facade\Pdf;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::all();

        return view('users.index', compact('users'));
    }

    public function report()
    {
        $users = User::with('projects')->get();

        $image = '/images/Laravel-logo.jpg';

        $pdf = Pdf::loadView('users.report', compact('users', 'image'));

        return $pdf->stream('users_report.pdf');
    }
}

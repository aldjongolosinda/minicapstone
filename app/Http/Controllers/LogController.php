<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    //
    public function index()
    {
        $logEntries = Log::orderBy('created_at', 'desc')->paginate(10);

        // Format the created_at timestamps
        $logEntries->transform(function ($logEntry) {
            $logEntry->formattedCreatedAt = Carbon::parse($logEntry->created_at)->format('F-d-Y');
            return $logEntry;
        });

        return view('admin.logs', ['logEntries' => $logEntries]);
    }
}

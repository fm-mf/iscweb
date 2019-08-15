<?php

namespace App\Http\Controllers\Partak;

use App\Http\Controllers\Controller;
use Rap2hpoutre\LaravelLogViewer\LogViewerController;

class LogsController extends Controller
{
    public function index()
    {
        $this->authorize('acl', 'logs');
        return (new LogViewerController())->index();
    }
}

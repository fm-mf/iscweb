<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class GithubController extends Controller
{
    public function githubUpdate(Request $request)
    {
        shell_exec('/var/www/.iscweb.deploy');
    }

}

[
    ''
]

?>

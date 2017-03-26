<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class GithubController extends Controller
{
    public function githubUpdate(Request $request)
    {
        $payload = $request;
        if ( $payload['ref'] != 'refs/heads/master' )
        {
            shell_exec('echo uncool >> /var/www/deploy-scripts/log');
            shell_exec('echo "Ignoring push to ' . $payload['ref'] . '." >> /var/www/deploy-scripts/log');
            return;
        }
        print ('cool');
	shell_exec('/var/www/deploy-scripts/iscweb');
    }
}

[
    ''
]

?>

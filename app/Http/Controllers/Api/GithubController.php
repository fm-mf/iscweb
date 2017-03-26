<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class GithubController extends Controller
{
    public function githubUpdate(Request $request)
    {

	//$payload = decodePayload($request->get('payload'));
    $payload = $request;
	if ( $payload['ref'] != 'refs/heads/master' )
	{
		shell_exec('echo "Ignoring push to ' . $request->payload('ref') . '." >> /var/www/deploy-scripts/log');
		return;
	}
	shell_exec('/var/www/deploy-scripts/iscweb');
    }

    /*
    public function decodePayload($payload)
    {
        return json_decode($payload);
    }
    */

}

[
    ''
]

?>

<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Models\AlumniNewsletter;
use Illuminate\Http\Request;

class AlumniNewsletterController extends Controller
{

    public function __construct()
    {
        app()->setLocale('cs');
        setlocale(LC_ALL, 'cs_CZ.UTF-8'); // for Carbon formatLocalized method
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $newsletters = AlumniNewsletter::paginate(10);

        return view('alumni.newsletters.index')->with('newsletters', $newsletters);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('acl', 'alumniNewsletter.create');

        return view('alumni.newsletters.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('acl', 'alumniNewsletter.create');

        $data = $request->validate([
            'title' => ['required', 'string'],
            'perex' => ['string', 'nullable'],
            'date_sent' => ['required', 'date'],
            'link' => ['required', 'active_url'],
        ]);

        AlumniNewsletter::create($data);

        return redirect()->route('alumni.newsletters.index')->withSuccess("Newsletter byl úspěšně přidán.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AlumniNewsletter  $alumniNewsletter
     * @return \Illuminate\Http\Response
     */
    public function show(AlumniNewsletter $alumniNewsletter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AlumniNewsletter  $alumniNewsletter
     * @return \Illuminate\Http\Response
     */
    public function edit(AlumniNewsletter $alumniNewsletter)
    {
        $this->authorize('acl', 'alumniNewsletter.update');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AlumniNewsletter  $alumniNewsletter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AlumniNewsletter $alumniNewsletter)
    {
        $this->authorize('acl', 'alumniNewsletter.update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AlumniNewsletter  $alumniNewsletter
     * @return \Illuminate\Http\Response
     */
    public function destroy(AlumniNewsletter $alumniNewsletter)
    {
        $this->authorize('acl', 'alumniNewsletter.delete');
        if (!$alumniNewsletter->delete()) {
            return redirect()->route('alumni.newsletters.index')->withErrors("Newsletter se nepodařilo odstranit!");
        }
        return redirect()->route('alumni.newsletters.index')->withSuccess("Newsletter byl úspěšně odstraněn!");
    }
}

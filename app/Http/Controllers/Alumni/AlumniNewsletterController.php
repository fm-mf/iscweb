<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Models\AlumniNewsletter;
use Illuminate\Http\Request;

class AlumniNewsletterController extends Controller
{

    private $newsletterValidationRules = [
        'title' => ['required', 'string'],
        'perex' => ['string', 'nullable'],
        'date_sent' => ['required', 'date'],
        'link' => ['required', 'active_url'],
    ];

    public function __construct()
    {
        app()->setLocale('cs');
        setlocale(LC_ALL, 'cs_CZ.UTF-8'); // for Carbon formatLocalized method
        $this->middleware('auth')->except(['index']);
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

        $data = $request->validate($this->newsletterValidationRules);

        AlumniNewsletter::create($data);

        return redirect()->route('alumni.newsletters.index')->withSuccess("Newsletter byl úspěšně přidán.");
    }

    /**
     * Display the soft-deleted resources.
     *
     * @return \Illuminate\Http\Response
     */
    public function showDeleted()
    {
        $this->authorize('acl', 'alumniNewsletter.create');
        $this->authorize('acl', 'alumniNewsletter.delete');

        $deletedNewsletters = AlumniNewsletter::onlyTrashed()->paginate(10);

        return view('alumni.newsletters.deleted')->with('deletedNewsletters', $deletedNewsletters);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AlumniNewsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function edit(AlumniNewsletter $newsletter)
    {
        $this->authorize('acl', 'alumniNewsletter.update');

        return view('alumni.newsletters.edit')->with('newsletter', $newsletter);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AlumniNewsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AlumniNewsletter $newsletter)
    {
        $this->authorize('acl', 'alumniNewsletter.update');

        $data = $request->validate($this->newsletterValidationRules);

        $newsletter->update($data);

        return redirect()->route('alumni.newsletters.index')->withSuccess("Newsletter byl úspěšně aktualizován.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AlumniNewsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function destroy(AlumniNewsletter $newsletter)
    {
        $this->authorize('acl', 'alumniNewsletter.delete');
        if (!$newsletter->delete()) {
            return redirect()->route('alumni.newsletters.index')->withErrors("Newsletter se nepodařilo odstranit!");
        }
        return redirect()->route('alumni.newsletters.index')->withSuccess("Newsletter byl úspěšně odstraněn!");
    }

    /**
     * Restores the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $this->authorize('acl', 'alumniNewsletter.delete');
        $this->authorize('acl', 'alumniNewsletter.create');

        $newsletter = AlumniNewsletter::onlyTrashed()->findOrFail($id);

        if (!$newsletter->restore()) {
            return redirect()->route('alumni.newsletters.deleted')->withErrors("Newsletter se nepodařilo obnovit!");
        }

        return redirect()->route('alumni.newsletters.deleted')->withSuccess("Newsletter byl úspěšně obnoven!");
    }
}

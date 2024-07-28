<?php

namespace App\Http\Controllers\Partak;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Http\Resources\ContactCollection;
use App\Models\Contact;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactsSettingsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('acl', 'settings.edit');

        return view('partak.settings.contacts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('acl', 'settings.edit');

        return view('partak.settings.contacts.edit')->with([
            'photoTypes' => [
                Contact::$MALE_PHOTO_TYPE => 'Male silhouette',
                Contact::$FEMALE_PHOTO_TYPE => 'Female silhouette',
                Contact::$CUSTOM_PHOTO_TYPE => 'Custom photo',
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreContactRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContactRequest $request)
    {
        $this->authorize('acl', 'settings.edit');

        $contact = Contact::create($request->all());

        return redirect(route('partak.settings.contacts.index'))->with([
            'success' => [
                'event' => 'events.contact_created',
                'position' => $contact->position,
            ],
        ]);
    }

    /**
     * Return json response with all contacts the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $this->authorize('acl', 'settings.edit');

        return new ContactCollection(Contact::all());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        $this->authorize('acl', 'settings.edit');

        $contact->phone = $contact->phoneWithSpaces;

        return view('partak.settings.contacts.edit')->with([
            'contact' => $contact,
            'photoTypes' => [
                Contact::$MALE_PHOTO_TYPE => 'Male silhouette',
                Contact::$FEMALE_PHOTO_TYPE => 'Female silhouette',
                Contact::$CUSTOM_PHOTO_TYPE => 'Custom photo',
            ],
            'photoSrc' => $contact->photoFilePath,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateContactRequest $request, Contact $contact)
    {
        $this->authorize('acl', 'settings.edit');

        $contact->update($request->all());

        if ($request->ajax()) {
            return response()->json([
                'message' => __('events.contact_updated', [
                    'position' => $contact->position,
                ]),
            ]);
        }

        return redirect(route('partak.settings.contacts.index'))->with([
            'success' => [
                'event' => 'events.contact_updated',
                'position' => $contact->position,
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function move(Request $request, Contact $contact)
    {
        $this->authorize('acl', 'settings.edit');

        if ($contact->order !== $request->oldIndex) {
            return response()->json([
                'message' => "Failed to move the $contact->position contact due to the order inconsistency.<br />" .
                    "Old index: $request->oldIndex != DB order: $contact->order",
            ], Response::HTTP_BAD_REQUEST);
        }
        $contact->move($request->oldIndex, $request->newIndex);

        return response()->json([
            'message' => __('events.contact_moved', [
                'position' => $contact->position,
            ]),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $this->authorize('acl', 'settings.edit');

        $deletedOrder = $contact->order;
        $contact->delete();
        $subsequentContacts = Contact::allWithSubsequentOrder($deletedOrder)->get();
        $subsequentContacts->each(function (Contact $contact) {
            $contact->order -= 1;
            $contact->save();
        });

        return response()->json([
            'message' => __('events.contact_deleted', [
                'position' => $contact->position,
            ]),
        ]);
    }
}

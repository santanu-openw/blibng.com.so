<?php

namespace Zix\Core\Http\Controllers\Admin;

use Zix\Core\Http\Requests\Admin\Contact\ContactDestroyRequest;
use Zix\Core\Http\Requests\Admin\Contact\ContactShowRequest;
use Zix\Core\Http\Requests\Admin\Contact\ContactStoreRequest;
use Zix\Core\Http\Requests\Admin\Contact\ContactUpdateRequest;
use Zix\Core\Http\Resources\Admin\ContactResource;
use Zix\Core\Models\Contact;

/**
 * Class ContactController
 * @package Zix\Core\Http\Controllers\Admin
 * @resource Admin Contact
 */
class ContactController
{
    /**
     * @var Contact
     */
    private $model;


    /**
     * ContactController constructor.
     * @param Contact $model
     */
    public function __construct(Contact $model)
    {
        $this->model = $model;
    }

    /**
     * @param ContactShowRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(ContactShowRequest $request)
    {
        return datatables()->eloquent($this->model->query())->toJson();
    }

    /**
     * @param ContactShowRequest $request
     * @param Contact $contact
     * @return ContactResource
     */
    public function show(ContactShowRequest $request, Contact $contact)
    {
        return new ContactResource($contact);
    }

    /**
     * @param ContactStoreRequest $request
     * @return ContactResource
     */
    public function store(ContactStoreRequest $request)
    {
        return new ContactResource($this->model->create($request->input()));
    }

    /**
     * @param ContactUpdateRequest $request
     * @param Contact $contact
     * @return ContactResource
     */
    public function update(ContactUpdateRequest $request, Contact $contact)
    {
        $contact->update($request->input());
        return new ContactResource($contact);
    }

    /**
     * @param ContactDestroyRequest $request
     * @param Contact $contact
     * @return ContactResource
     * @throws \Exception
     */
    public function destroy(ContactDestroyRequest $request, Contact $contact)
    {
        $contact->delete();
        return new ContactResource($contact);
    }

}
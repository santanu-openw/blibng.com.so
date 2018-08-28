<?php

namespace Zix\Core\Http\Controllers;


use Zix\Core\Http\Requests\User\UserContactStoreRequest;
use Zix\Core\Models\Contact;

class ContactController
{
    public function store(UserContactStoreRequest $request)
    {
        $contact = Contact::create($request->input());

        return "Your Contact Request Was Received Successfully";
    }
}
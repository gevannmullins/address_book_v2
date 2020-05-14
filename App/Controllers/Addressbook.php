<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\Addressbook as Contacts;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class Addressbook extends \Core\Controller
{

    public function view_addressbook()
    {

        $contacts = Contacts::getAll();

        View::renderTemplate('Home/index.html', [
            'contacts' => $contacts
        ]);

    }

    public function view_new_contact()
    {
        View::render('_forms/add_edit_contact.php', [
            'mode' => 'new'
        ]);
    }

    public function view_edit_contact($request, $response, $service)
    {
        $contact_id = $request->contact_id;
        $contact = Contacts::getContactById($contact_id);
        View::render('_forms/add_edit_contact.php', [
            'mode' => 'edit',
            'contact_info' => $contact[0]
        ]);
    }

    public function view_new_contact_info($request, $response, $service)
    {
        $contact_id = $request->contact_id;
        View::render('_forms/add_edit_contact_info.php', [
            'mode' => 'new',
            'contact_id' => $contact_id
        ]);
    }

    public function view_edit_contact_info($request, $response, $service)
    {
        $contact_id = $request->contact_id;
        $contact_info_id = $request->contact_info_id;
        $contact = Contacts::getContactInfoById($contact_info_id);
        View::render('_forms/add_edit_contact_info.php', [
            'mode' => 'edit',
            'contact_id' => $contact_id,
            'contact_info' => $contact[0]
        ]);
    }



}

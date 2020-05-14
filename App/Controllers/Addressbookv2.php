<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\Addressbook as Contacts;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class Addressbookv2 extends \Core\Controller
{

    public function search_addressbook($request, $response, $service)
    {
        $search_value = $request->search_value;

        $contacts = Contacts::getAllSearchedData($search_value);
        $contacts_all = Contacts::getAllSearchedData($search_value);

        View::renderTemplate('v2/index.html', [
            'page_title' => 'V2',
            'contacts' => $contacts,
            'contacts_all' => $contacts_all
        ]);

    }
    public function index()
    {
        $contacts = Contacts::getAll();
        $contacts_all = Contacts::getAllAddressBookData();

        View::renderTemplate('v2/index.html', [
            'page_title' => 'V2',
            'contacts' => $contacts,
            'contacts_all' => $contacts_all
        ]);

    }


    public function view_new_contact_info()
    {
        View::render('_forms/add_edit_contact_info.php', [
            'mode' => 'new'
        ]);
    }

    public function view_edit_contact_info($request, $response, $service)
    {
        $contact_id = $request->contact_id;
        $contact = Contacts::getContactById($contact_id);
        View::render('_forms/add_edit_contact_info.php', [
            'mode' => 'edit',
            'contact_info' => $contact[0]
        ]);
    }


}

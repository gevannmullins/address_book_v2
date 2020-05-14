<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\Addressbook as Contacts;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class Addressbookapi extends \Core\Controller
{

    public function getAllContactsFull()
    {
        $contacts = Contacts::getAllAddressBookData();
        return json_encode($contacts, true);
    }

    public function getAllContacts()
    {
        $contacts = Contacts::getAll();
        return json_encode($contacts);
    }

    public function getContactInfo($request, $response, $service)
    {
        $contact_id = $request->contact_id;
        $contacts = Contacts::getAll();
        return json_encode($contacts);
    }

    public function getContactInfoById($request, $response, $service)
    {
        $contact_id = $request->contact_info_id;
        $contacts = Contacts::getAll();
        return json_encode($contacts);
    }


    public function addNewContact($request, $response, $service)
    {
        $requestData = $request->params();

        $name = $requestData['name'];
        $surname = $requestData['surname'];
        $nickname = $requestData['nickname'];
//        $contact_id = $requestData['contact_id'];
        $mode = $requestData['mode'];
        $contact_id = $requestData['contact_id'];
        $date_created = date("Y-m-d H:i:s");
        $date_updated = date("Y-m-d H:i:s");

        if($mode === 'new') {
            $responseData = Contacts::newContact($name, $surname, $nickname, $date_created, $date_updated);
        }elseif ($mode === 'edit') {
            $responseData = Contacts::editContact($name, $surname, $nickname, $date_updated, $contact_id);
        }

        return json_encode($responseData);

    }


    public function deleteContact($request, $response, $service)
    {
        $requestData = $request->params();
        $contact_id = $requestData['contact_id'];
//        $contact_id = $request->contact_id;
        $responseData = Contacts::deleteContact($contact_id);
        return json_encode($responseData);

    }


    public function addNewContactInfo($request, $response, $service)
    {
        $requestData = $request->params();

        $contact_type = $requestData['contact_type'];
        $contact_value = $requestData['contact_value'];
        $contact_id = $requestData['contact_id'];
//        $contact_id = $requestData['contact_id'];
        $mode = $requestData['mode'];
        $contact_info_id = $requestData['contact_info_id'];
        $date_created = date("Y-m-d H:i:s");
        $date_updated = date("Y-m-d H:i:s");

        if($mode === 'new') {
            $responseData = Contacts::newContactInfo($contact_id, $contact_type, $contact_value, $date_created, $date_updated);
        }elseif ($mode === 'edit') {
            $responseData = Contacts::editContactInfo($contact_info_id, $contact_id, $contact_type, $contact_value, $date_updated);
        }

        return json_encode($responseData);

    }


    public function deleteContactInfo($request, $response, $service)
    {
        $requestData = $request->params();
        $contact_info_id = $requestData['contact_info_id'];
        $responseData = Contacts::deleteContactInfo($contact_info_id);
        return json_encode($responseData);

    }





}



<?php

/**
 * Routing
 */
$router = new Core\Router();

// Add the routes
//$router->respondWithController('GET', '/[:name]', 'Home@index');
//$router->respondWithController('GET', '/', 'Addressbook@view_addressbook');

// Redirecting the user to the new version
$router->respond('GET', '/', function(){
    header("Location: /v2");
    return '<script>location.replace("/v2");</script>';
});

// FORMS
$router->respondWithController('GET', '/address_book/add_new_view', 'Addressbook@view_new_contact');
$router->respondWithController('GET', '/address_book/add_new_view/[:contact_id]', 'Addressbook@view_edit_contact');
$router->respondWithController('GET', '/address_book/add_new_contact_info/[:contact_id]', 'Addressbook@view_new_contact_info');
$router->respondWithController('GET', '/address_book/add_new_contact_info/[:contact_id]/[:contact_info_id]', 'Addressbook@view_edit_contact_info');

// V2 Routes
$router->respondWithController('GET', '/v2', 'Addressbookv2@index');
$router->respondWithController('GET', '/v2/search/[:search_value]', 'Addressbookv2@search_addressbook');


// API calls
$router->respondWithController('GET', '/api/address_book/contacts', 'Addressbookapi@getAllContacts');
$router->respondWithController('GET', '/api/address_book/contacts_full', 'Addressbookapi@getAllContactsFull');
$router->respondWithController('GET', '/api/address_book/contact_info/[:contact_id]', 'Addressbookapi@getContactInfo');
$router->respondWithController('POST', '/api/address_book/add_new_contact', 'Addressbookapi@addNewContact');
$router->respondWithController('POST', '/api/address_book/delete_contact/[:contact_id]', 'Addressbookapi@deleteContact');
$router->respondWithController('POST', '/api/address_book/add_new_contact_info/[:contact_id]', 'Addressbookapi@addNewContactInfo');
$router->respondWithController('POST', '/api/address_book/delete_contact_info/[:contact_info_id]', 'Addressbookapi@deleteContactInfo');

// Dispatch the router
$router->dispatch();
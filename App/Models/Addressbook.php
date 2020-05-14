<?php

namespace App\Models;

use PDO;

/**
 * Example user model
 *
 * PHP version 7.0
 */
class Addressbook extends \Core\Model
{

    public static function searchByValue($search_value) {
        $db = static::getDB();
        $sql = "SELECT * FROM contacts WHERE name LIKE '%" . $search_value . "%'OR surname LIKE '%" . $search_value . "%'";
        $stmt = $db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public static function getAll()
    {
        $db = static::getDB();
        $stmt = $db->query('SELECT * FROM contacts');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getAllAddressBookData()
    {
        $return_data = [];
        $contacts = static::getAllContacts();

        foreach ($contacts as $contact) {
            $return_data[] = [
                'contact' => $contact,
                'contact_info' => static::getContactInfo($contact['id'])
            ];
        }

        return $return_data;
    }

    public static function getAllSearchedData($search_value)
    {
        $return_data = [];
        $contacts = static::searchByValue($search_value);

        foreach ($contacts as $contact) {
            $return_data[] = [
                'contact' => $contact,
                'contact_info' => static::getContactInfo($contact['id'])
            ];
        }

        return $return_data;
    }

    public static function getAllContacts()
    {
        $db = static::getDB();
        $stmt = $db->query('SELECT * FROM contacts');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getContactById($contact_id)
    {
        $db = static::getDB();
        $stmt = $db->query("SELECT * FROM contacts WHERE id = $contact_id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getContactInfoById($contact_info_id)
    {
        $db = static::getDB();
        $stmt = $db->query("SELECT * FROM contact_information WHERE id = '$contact_info_id'");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getContactByPhone($contact_id)
    {
        $db = static::getDB();
        $stmt = $db->query("SELECT * FROM contacts WHERE id = $contact_id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public static function getContactInfo($contact_id)
    {
        $db = static::getDB();
        $stmt = $db->query("SELECT * FROM contact_information WHERE contact_id = $contact_id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function searchByAddress($param) {
        $sql = "SELECT * 
                FROM contacts as t1 
                LEFT JOIN contact_information as t2 on t1.id = t2.contact_id
                WHERE t2.contact_type = 'address'
                AND t2.contact_value 
                    LIKE '%" . $this->db->escape($param['address']) . "%'";

        return $this->db->query($sql)->rows;
    }

    public function getCountContacts() {
        $query = $this->db->query("SELECT COUNT(*) as total FROM contacts");

        return ($query->num_rows > 0) ? (int) $query->row['total'] : 0;
    }

    public function getCountPhoneNumbers() {
        $query = $this->db->query("SELECT COUNT(*) as total FROM contact_information WHERE contact_type = 'phone'");

        return ($query->num_rows > 0) ? (int) $query->row['total'] : 0;
    }

    public function getCountAddresses() {
        $query = $this->db->query("SELECT COUNT(*) as total FROM contact_information WHERE contact_type = 'address'");

        return ($query->num_rows > 0) ? (int) $query->row['total'] : 0;
    }

    public function newEntry($param)
    {
        $date_created = date('Y-m-d H:i:s');

        $name = $param['name'];
        $surname = $param['surname'];
        $nickname = $param['nickname'];
        $contact_type = $param['contact_type'];
        $contact_value = $param['contact_value'];

        $contact_id = $this->newContact($name,$surname, $nickname, $date_created);
        if ($contact_id === false) {
            return $contact_id;
        } else {
            return $this->newContactInfo($contact_id, $contact_type, $contact_value, $date_created);
        }

    }

    //// Contacts
    /**
     * @param $name
     * @param $surname
     * @param $nickname
     * @param $date_created
     * @param $date_updated
     * @return mixed
     */
    public static function newContact($name, $surname, $nickname, $date_created, $date_updated)
    {
        $db = static::getDB();
        $sql = "INSERT INTO contacts (name, surname, nickname, date_created, date_updated) VALUES ('$name', '$surname', '$nickname', '$date_created', '$date_updated')";
        $stmt = $db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param $name
     * @param $surname
     * @param $nickname
     * @param $date_updated
     * @param $contact_id
     * @return mixed
     */
    public static function editContact($name, $surname, $nickname, $date_updated, $contact_id)
    {
        $db = static::getDB();
        $sql = "UPDATE contacts SET name='$name', surname='$surname', nickname='$nickname', date_updated='$date_updated' WHERE id='$contact_id'";
        $stmt = $db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param $contact_id
     * @return mixed
     */
    public static function deleteContact($contact_id)
    {
        static::deleteAllContactInfo($contact_id);
        $db = static::getDB();
        $sql = "DELETE FROM contacts WHERE id='$contact_id'";
        $stmt = $db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param $contact_id
     * @return mixed
     */
    public static function deleteAllContactInfo($contact_id)
    {
        $db = static::getDB();
        $sql = "DELETE FROM contact_information WHERE contact_id='$contact_id'";
        $stmt = $db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //// End Contacts


    //// Contact Information
    /**
     * @param $contact_id
     * @param $contact_type
     * @param $contact_value
     * @param $date_created
     * @param $date_updated
     * @return mixed
     */
    public static function newContactInfo($contact_id, $contact_type, $contact_value, $date_created, $date_updated)
    {
        $db = static::getDB();
        $sql = "INSERT INTO contact_information (contact_id, contact_type, contact_value, date_created, date_updated) VALUES ('$contact_id', '$contact_type', '$contact_value', '$date_created', '$date_updated')";
        $stmt = $db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param $contact_info_id
     * @param $contact_id
     * @param $contact_type
     * @param $contact_value
     * @param $date_updated
     * @return mixed
     */
    public static function editContactInfo($contact_info_id, $contact_id, $contact_type, $contact_value, $date_updated)
    {
        $db = static::getDB();
        $sql = "UPDATE contact_information SET contact_id='$contact_id', contact_type='$contact_type', contact_value='$contact_value', date_updated='$date_updated' WHERE id='$contact_info_id'";
        $stmt = $db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param $contact_info_id
     * @return mixed
     */
    public static function deleteContactInfo($contact_info_id)
    {
        $db = static::getDB();
        $sql = "DELETE FROM contact_information WHERE id='$contact_info_id'";
        $stmt = $db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //// End Contact Information






}

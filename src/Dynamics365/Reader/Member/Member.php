<?php

namespace LuzernTourismus\M365Mail\Dynamics365\Reader\Member;

class Member
{

    public readonly string $companyId;

    public readonly string $contactId;

    public readonly string $displayName;

    public readonly string $salutation;

    public readonly string $firstName;

    public readonly string $lastName;

    public readonly string $email;

    public readonly string|null $phone;
    public readonly string|null $mobile;

    public readonly string $company;

    public readonly string $street;

    public readonly string $postalCode;

    public readonly string $city;


    public function __construct($data)
    {

        $this->contactId = $data['contactid'];
        $this->salutation = $data['salutation'];
        $this->displayName = $data['fullname'];
        $this->firstName = $data['firstname'];
        $this->lastName = $data['lastname'];
        $this->email = $data['emailaddress1'];

        if (is_string($data['telephone1'])) {
            $this->phone = $data['telephone1'];
        } else {
            $this->phone = null;
        }

        if (is_string($data['mobilephone'])) {
            $this->mobile = $data['mobilephone'];
        } else {
            $this->mobile = null;
        }

        $this->companyId = $data['parentcustomerid_account']['accountid'];
        $this->company = $data['parentcustomerid_account']['name'];

        if (is_string($data['parentcustomerid_account']['address1_line1'])) {
            $this->street = $data['parentcustomerid_account']['address1_line1'];
        } else {
            $this->street = null;
        }
        //$this->street = $data['parentcustomerid_account']['address1_line1'];


        if (is_string($data['parentcustomerid_account']['address1_postalcode'])) {
            $this->postalCode = $data['parentcustomerid_account']['address1_postalcode'];
        } else {
            $this->postalCode = null;
        }

        if (is_string($data['parentcustomerid_account']['address1_city'])) {
            $this->city = $data['parentcustomerid_account']['address1_city'];
        } else {
            $this->city = null;
        }
        //$this->city = $data['parentcustomerid_account']['address1_city'];

    }

}
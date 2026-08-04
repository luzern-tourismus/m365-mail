<?php

namespace LuzernTourismus\M365Mail\Dynamics365\Reader\Member;

class Member
{

    public readonly string $id;

    public readonly string $displayName;

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

        $this->id = $data['contactid'];
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

        $this->company = $data['parentcustomerid_account']['name'];
        $this->street = $data['parentcustomerid_account']['address1_line1'];
        $this->postalCode = $data['parentcustomerid_account']['address1_postalcode'];
        $this->city = $data['parentcustomerid_account']['address1_city'];

    }

}
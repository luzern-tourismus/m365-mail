<?php

namespace LuzernTourismus\M365Mail\Dynamics365\Reader\Member;

class Member
{

    //crmIdentifier

    public readonly string|null $companyId;

    public readonly string $contactId;

    public readonly string $displayName;

    public readonly string|null $salutation;

    public readonly string $firstName;

    public readonly string $lastName;

    public readonly string $email;

    public readonly string|null $phone;
    public readonly string|null $mobile;

    public readonly bool $hasCompany;


    public readonly string|null $company;

    public readonly string|null $street;

    public readonly string|null $postalCode;

    public readonly string|null $city;


    public function __construct($data)
    {

        $this->contactId = $data['contactid'];

        /*if (is_string($data['salutation'])) {
            $this->salutation = $data['salutation'];
        } else {
            $this->salutation = null;
        }*/


        $fieldName = 'lt_anredecode@OData.Community.Display.V1.FormattedValue';
        if (is_string($data[$fieldName])) {
            $this->salutation = $data[$fieldName];
        } else {
            $this->salutation = null;
        }

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

        if (isset($data['parentcustomerid_account'])) {

            $this->hasCompany = true;

            if (is_string($data['parentcustomerid_account']['accountid'])) {
                $this->companyId = $data['parentcustomerid_account']['accountid'];
            } else {
                $this->companyId = null;
            }

            if (is_string($data['parentcustomerid_account']['name'])) {
                $this->company = $data['parentcustomerid_account']['name'];
            } else {
                $this->company = null;
            }

            if (is_string($data['parentcustomerid_account']['address1_line1'])) {
                $this->street = $data['parentcustomerid_account']['address1_line1'];
            } else {
                $this->street = null;
            }

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

        } else {

            $this->hasCompany = false;

        }

    }

}
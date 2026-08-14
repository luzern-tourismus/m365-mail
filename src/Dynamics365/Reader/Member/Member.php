<?php

namespace LuzernTourismus\M365Mail\Dynamics365\Reader\Member;

use Nemundo\Core\Base\AbstractBase;

class Member extends AbstractBase
{

    //crmIdentifier

    public readonly string|null $companyId;

    public readonly string $contactId;

    public readonly string $displayName;

    public readonly string|null $salutation;

    public readonly string|null $firstName;

    public readonly string|null $lastName;

    public readonly string|null $email;

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
        if (isset($data[$fieldName])) {
            if (is_string($data[$fieldName])) {
                $this->salutation = $data[$fieldName];
            } else {
                $this->salutation = null;
            }
        } else {
            $this->salutation = null;
        }

        $this->displayName = $data['fullname'];

        $value = $data['firstname'];
        if (is_string($value)) {
            $this->firstName = $value;  // $data['firstname'];
        } else {
            $this->firstName = null;
        }

        $value = $data['lastname'];
        if (is_string($value)) {
            $this->lastName = $value;  // $data['lastname'];
        } else {
            $this->lastName = null;
        }

        $value = $data['emailaddress1'];
        if (is_string($value)) {
            $this->email = $value;
        } else {
            $this->email = null;
        }

        $value = $data['telephone1'];
        if (is_string($value)) {
            $this->phone = $value;  // $data['telephone1'];
        } else {
            $this->phone = null;
        }

        $value = $data['mobilephone'];
        if (is_string($value)) {
            $this->mobile = $value;  // $data['mobilephone'];
        } else {
            $this->mobile = null;
        }

        if (isset($data['parentcustomerid_account'])) {

            $this->hasCompany = true;

            $value = $data['parentcustomerid_account']['accountid'];
            if (is_string($value)) {
                $this->companyId = $value;  // $data['parentcustomerid_account']['accountid'];
            } else {
                $this->companyId = null;
            }

            $value = $data['parentcustomerid_account']['name'];
            if (is_string($value)) {
                $this->company = $value; // $data['parentcustomerid_account']['name'];
            } else {
                $this->company = null;
            }

            $value = $data['parentcustomerid_account']['address1_line1'];
            if (is_string($value)) {
                $this->street = $value;  // $data['parentcustomerid_account']['address1_line1'];
            } else {
                $this->street = null;
            }

            $value = $data['parentcustomerid_account']['address1_postalcode'];
            if (is_string($value)) {
                $this->postalCode = $value;  // $data['parentcustomerid_account']['address1_postalcode'];
            } else {
                $this->postalCode = null;
            }

            $value = $data['parentcustomerid_account']['address1_city'];
            if (is_string($value)) {
                $this->city = $value;  // $data['parentcustomerid_account']['address1_city'];
            } else {
                $this->city = null;
            }

        } else {

            $this->hasCompany = false;

        }

    }

}
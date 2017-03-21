<?php

namespace App\Helpers\Contracts;
interface Validate{

    public function validateForm($data);
    public function getErrorsMessages();

}
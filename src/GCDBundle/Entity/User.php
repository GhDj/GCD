<?php

namespace GCDBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 */
class User extends BaseUser
{
    protected $id;
    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
}
<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 11/27/2018
 * Time: 10:48 AM
 */
class People extends IURFCBase
{
    public function getImage()
    {
        return $this->getPostMeta('profile-image');
    }
}
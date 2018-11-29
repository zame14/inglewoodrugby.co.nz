<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 11/18/2018
 * Time: 2:03 PM
 */
class Sponsor extends IURFCBase
{
    public function getLogo()
    {
        return $this->getPostMeta('sponsor-logo');
    }
    public function getLink()
    {
        return $this->getPostMeta('sponsor-url');
    }
    public function getSponsorType()
    {
        return $this->getPostMeta('sponsor-type');
    }
    public function output() {
        $html = '<img src="' . $this->getLogo() . '" alt="' . $this->getTitle() . '" class="responsive-img" />';

        return $html;
    }
}
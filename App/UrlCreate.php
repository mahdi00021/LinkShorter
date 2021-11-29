<?php

namespace Application\App;


use Application\Repository\UrlRepository;

class UrlCreate
{

    public function createUrl($url, $date)
    {

        $urlRepository = new UrlRepository();
        $urlRepository->create($url, $date);

    }

}
<?php

namespace Application\App;

class UrlUpdate
{

    public function updateUrl($short_code, $url)
    {
        $urlRepository = new \Application\Repository\UrlRepository();
        $urlRepository->update($short_code, $url);
    }

}
<?php

namespace Application\App;

class UrlDelete
{
    public function deleteUrl($short_code)
    {
        $urlRepository = new \Application\Repository\UrlRepository();
        $urlRepository->delete($short_code);
    }

}
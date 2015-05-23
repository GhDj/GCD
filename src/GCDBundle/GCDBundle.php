<?php

namespace GCDBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class GCDBundle extends Bundle
{
    public function getParent()
   {
    return 'FOSUserBundle';
   }
}

<?php

namespace SL\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SLUserBundle extends Bundle
{
    public function getParent()
  {
    return 'FOSUserBundle';
  }
}

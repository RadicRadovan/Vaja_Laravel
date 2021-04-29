<?php

namespace Statamic\Addons\WindFinder;

use Statamic\Extend\Tags;

class WindFinderTags extends Tags
{
  public function all()
  {
    return WindFinder::data();
  }

  public function speed()
  {
    return WindFinder::data('WindAvgSpeedCur');
  }

  // etc...
}
<?php

namespace Statamic\Addons\WindFinder;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

class WindFinder extends Model
{
 protected $table = 'mystation';

 public static function data($column = null)
 {
    $data = Cache::remember('all', 1, function () {
      return self::all()->last();
    });

    if ($data) {
      if ($column) {
        return $data->$column;
      } else {
        return $data;
      }
    } else {
      return null;
    }
  }
}
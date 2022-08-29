<?php

use Carbon\Carbon;

function getImage($img): string
{
    return  env('APP_URL').'/storage/images/'.$img;
}

function getThumbImage($img): string
{
    return  env('APP_URL').'public/storage/images/thumbs/'.$img;
}

function getDateFor($date): string
{
    return Carbon::createFromFormat('Y-m-d H:i:s', $date)->diffForHumans();
}

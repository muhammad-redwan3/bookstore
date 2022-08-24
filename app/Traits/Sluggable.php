<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait Sluggable
{
//    FOR ARABIC language
    public static function slug($str)
    {
        $string = preg_replace("/[^a-z0-9_\s۰۱۲۳۴۵۶۷۸۹يءاأإآؤئبپتثجچحخدذرزژسشصضطظعغفقکكگگلمنوهی]#u/", '', $str);

        $string = preg_replace("/[\s-]+/", ' ', $string);

        $string = preg_replace("/[\s_]/", '-', $string);

        return $string;
    }
//    FOR unique Slug
    public static function uniqueSlug($slug,$table)
    {
        $slug=trim($slug);

        $items=DB::table($table)->select('slug')->whereRaw("slug like '$slug%'")->get();

        if(sizeof($items)){
            foreach($items as $item){
                $data[] = $item->slug;
            }
            $count = 0;
            $slug_str=$slug;
            while(in_array(($slug_str), $data) ){
                $slug_str = $slug .'-'. ++$count ;
            }
            return $slug_str;
        }
        return $slug;
    }
}

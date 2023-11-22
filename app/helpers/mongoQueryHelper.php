<?php

if (!function_exists('_insert_MONGODB')) {
    function _insert_MONGODB($table, $data)
    {
        $builder = DB::table($table);
        if ($builder->insert($data)) {
            return DB::getPdo();
        } else {
            return false;
        }
    }
}

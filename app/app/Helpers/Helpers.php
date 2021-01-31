<?php

if (!function_exists('get_class_name')) {
    function get_class_name($object): string
    {
        if (is_object($object)) {
            $object = get_class($object);
        }
        return substr($object, strrpos($object, '\\') + 1);
    }

    function subtract_array(array $array1, array $array2): array
    {
        foreach ($array2 as $item) {
            $key = array_search($item, $array1);
            if ($key !== false) {
                unset($array1[$key]);
            }
        }
        return array_values($array1);
    }

    function array_intersect_count($array1, $array2, &$result = 0): int
    {
        if (array_exists_in($array1, $array2)) {
            $result++;
            $array2 = subtract_array($array2, $array1);
            return array_intersect_count($array1, $array2, $result);
        }

        return $result;
    }

    function array_exists_in(array $array1, array $array2): bool
    {
        foreach ($array1 as $value) {
            if (($key = array_search($value, $array2)) === false) {
                return false;
            }
            unset($array2[$key]);
        }
        return true;
    }
}

<?php

use Validations as GlobalValidations;

class Validations
{
    private static  $check;

    public static function validateTypeIds($id)
    {
        if (intval($id) || $id == "ALL" || $id == 0 || $id == "0") {
            return Validations::$check = true;
        }
    }
    public static function removeSpecialCharacters($string)
    {
        $pattern = '/([!;\':\-\[\] ])/';
        return preg_replace($pattern, '', $string);
    }
    public static function wordsOnly($string)
    {
        $status = false;
        $pattern = '/^[a-zA-Z]+$/';

        $preg_match = preg_match($pattern, $string);

        if ($preg_match == '1' || $preg_match == true) {

            $status = true;
        }
        return $status;
    }
    public static function validatePageNumbers($pageNumber)
    {
        if (intval($pageNumber) || $pageNumber == 0 || $pageNumber == "0") return Validations::$check = true;
    }
    public static function checkValidationSingleValues($pgNum)
    {
        if (isset($pgNum)   && (intval($pgNum) or $pgNum == 0)) {
            Validations::$check = TRUE;
        } else {
            Validations::$check = FALSE;
        }
        return Validations::$check;
    }

    public static function checkValidation($pgNum, $sSubType)
    {
        if (isset($pgNum) && isset($sSubType) && (intval($sSubType) or $sSubType == 0) && (intval($pgNum) or $pgNum == 0)) {
            Validations::$check = TRUE;
        } else {
            Validations::$check = FALSE;
        }
        return Validations::$check;
    }

    public static function checkSearchValidation($pgNum, $searchText)
    {
        if (isset($pgNum) && isset($searchText) && is_string($searchText) && (intval($pgNum) or $pgNum == 0)) {
            Validations::$check = TRUE;
        } else {
            Validations::$check = FALSE;
        }
        return Validations::$check;
    }
}

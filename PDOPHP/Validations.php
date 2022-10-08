<?php

class Validations
{
    private static  $check;

    public static function checkValidationSingleValues($pgNum) 
    {
        if (isset($pgNum)   && (intval($pgNum) OR $pgNum==0)  )  {
            Validations::$check = TRUE;
        } else {
            Validations::$check = FALSE;
            
        }
        return Validations::$check;
    }

    public static function checkValidation($pgNum,$sSubType) 
    {
        if (isset($pgNum) && isset($sSubType) && (intval($sSubType) OR $sSubType ==0) && (intval($pgNum) OR $pgNum==0)  )  {
            Validations::$check = TRUE;
        } else {
            Validations::$check = FALSE;
            
        }
        return Validations::$check;
    }

    public static function checkSearchValidation($pgNum,$searchText){
        if(isset($pgNum) && isset($searchText) && is_string($searchText) && (intval($pgNum) OR $pgNum==0) ){
            Validations::$check = TRUE;
        }else{
            Validations::$check = FALSE;
        }
        return Validations::$check;
    }
}


<?php

namespace app\models;

class Where
{

    static function getClausule($searchField)
    {
        $ops = array(
            'eq' => '=', //equal
            'ne' => '<>', //not equal            
            'lt' => '<', //less than
            'le' => '<=', //less than or equal
            'gt' => '>', //greater than
            'ge' => '>=', //greater than or equal
            'bw' => 'LIKE', //begins with
            'bn' => 'NOT LIKE', //doesn't begin with
            'in' => 'IN', //is in
            'ni' => 'NOT IN', //is not in
            'ew' => 'LIKE', //ends with
            'en' => 'NOT LIKE', //doesn't end with
            'cn' => 'LIKE', // contains
            'nc' => 'NOT LIKE'  //doesn't contain
        );

        if ($searchField['groupOp'] === 'OR')
            $groupOp = 'OR';
        else
            $groupOp = 'AND';

        $rules = $searchField['rules'];

        $result = "";
        $amRules = [];

        $i = 0;
        foreach ($rules as $value)
        {
            $col = $value['field'];
            $oper = $value['op'];
            $val = $value['data'];

            if (!preg_match("/^\w*$/", $col))
                Yii::app()->end();

            preg_match_all("/[^\w\s^,]/", $val, $matchResult);

            foreach ($matchResult[0] as $r)
            {
                $val = str_replace($r, "\\" . $r, $val);
            }

            if ($col === 'additional_class_type' || $col === 'main_class_type')
            {
                $mcacRes = Where::AcMcWhere($value);
                array_push($amRules, $mcacRes);
            } else
            {
                if ($oper == 'bw' || $oper == 'bn')
                    $val = '"' . $val . '%"';
                elseif ($oper == 'ew' || $oper == 'en')
                    $val = '"%' . $val . '"';
                elseif ($oper == 'cn' || $oper == 'nc')
                    $val = '"%' . $val . '%"';
                elseif ($oper == 'in' || $oper == 'ni')
                    $val = '("' . str_replace(',', '","', $val) . '")';
                elseif ($oper == 'eq' || $oper == 'ne')
                    $val = '"' . $val . '"';
                else
                    $val = (double) $val;

                if ($i === 0)
                    $result .= "WHERE $col $ops[$oper] $val ";
                else
                    $result .= "$groupOp $col $ops[$oper] $val ";

                $i+=1;
            }
        }


        $amcq = "";

        $j = 0;
        foreach ($amRules as $amValue)
        {
            if ($j++ === 0)
                $amcq .= "($amValue)";
            else
                $amcq .= " AND ($amValue)";
        }

        if ($amcq !== "")
        {
            if ($result === "")
                $result .= "WHERE ($amcq)";
            else
                $result .= " AND ($amcq)";
        }

        return $result;
    }

    private static function AcMcWhere($value)
    {
        $data = rtrim($value['data'], ",");

        $delimited = explode(',', $data);

        $col = $value['field'];
        $oper = $value['op'];

        $groupOperator = 'AND';
        $operator = 'LIKE';

        if ($oper === 'nc' || $oper === 'ni')
        {
            $operator = 'NOT LIKE';
        }

        if ($oper === 'in' || $oper === 'nc')
        {
            $groupOperator = 'OR';
        }

        if ($col === 'additional_class_type')
        {
            if (count($delimited) > 1)
            {
                $val1 = '';
                $val2 = '';

                for ($i = 0; $i < count($delimited); $i++)
                {
                    $d = Where::GetAcWithSpaceAndBracket($delimited[$i]);

                    $val1 .= "additional_class_type_g $operator '%$d%'";
                    $val2 .= "additional_class_type_d $operator '%$d%'";

                    if ($i < count($delimited) - 1)
                    {
                        $val1 .= " $groupOperator ";
                        $val2 .= " OR ";
                    }
                }

                if ($oper === 'cn')
                {
                    return "(($val1) AND ($val2))";
                } else
                {
                    return "$val1";
                }
            } else
            {
                $d = Where::GetAcWithSpaceAndBracket($data);

                if ($operator === 'NOT LIKE')
                {
                    return "additional_class_type_g $operator '%$d%'";
                } else
                {
                    return "additional_class_type_g $operator '%$d%' AND additional_class_type_d $operator '%$d%'";
                }
            }
        } else
        {
            if (count($delimited) > 1)
            {
                $val1 = '';
                $val2 = '';

                for ($i = 0; $i < count($delimited); $i++)
                {
                    $d = trim($delimited[$i]);

                    $val1 .= "main_class_type_g $operator '%$d%'";
                    $val2 .= "main_class_type $operator '%$d%'";

                    if ($i < count($delimited) - 1)
                    {
                        $val1 .= " $groupOperator ";
                        $val2 .= " OR ";
                    }
                }

                if ($oper === 'cn')
                {
                    return "(($val1) AND ($val2))";
                } else
                {
                    return "$val1";
                }
            } else
            {
                $d = trim($data);
                if ($operator === 'NOT LIKE')
                {
                    return "main_class_type_g $operator '%$d%'";
                } else
                {
                    return "main_class_type_g $operator '%$d%' AND main_class_type $operator '%$d%'";
                }
            }
        }
    }

    private static function GetAcWithSpaceAndBracket($ac)
    {
        $ac = trim($ac);

        if ($ac[0] === '(')
            $ac = '( ' . substr($ac, 1);
        else
            $ac = ' ' . $ac;

        if ($ac[strlen($ac) - 1] === ')')
            $ac = substr($ac, 0, strlen($ac) - 1) . ' )';
        else
            $ac .= ' ';

        return $ac;
    }
}
<?php

namespace app\models;

class Math
{

    static function Factorial($number)
    {
        $result = 1.0;

        for ($i = 1; $i <= number; $i++)
        {
            $result = $result * i;
        }

        return $result;
    }

    static function Combinations($number, $numberChosen)
    {
        $result = 1.0;

        $upper = $number;
        $lower = $numberChosen;
        $upperLimit = $number - $numberChosen;


        while ($upper > $upperLimit || $lower > 1)
        {
            if ($upper > $upperLimit)
            {
                $result *= $upper;
                $upper--;
            }
            if ($lower > 1)
            {
                $result /= $lower;
                $lower--;
            }
        }

        return $result;
    }

    static function HypergeometricTest($successInSample, $sizeOfSample, $successInPopulation, $sizeOfPopulation, $cummulative)
    {
        $result = 0.0;

        if ($cummulative)
        {
            while ($successInSample <= $successInPopulation)
            {
                $result += Math::HypergeometricTest($successInSample++, $sizeOfSample, $successInPopulation, $sizeOfPopulation, false);
            }
        }
        else
        {
            $result = (Math::Combinations($sizeOfSample, $successInSample) * Math::Combinations($sizeOfPopulation - $sizeOfSample, $successInPopulation - $successInSample)) / Math::Combinations($sizeOfPopulation, $successInPopulation);
        }

        return $result;
    }

    static function FisherExactTest($successInSample, $sizeOfSample, $successInPopulation, $sizeOfPopulation, $alternative)
    {
        $result = 0.0;

        if ($alternative === "great")
        {
            $result = Math::HypergeometricTest($successInSample, $sizeOfSample, $successInPopulation, $sizeOfPopulation, true);
        }
        else if ($alternative === "less")
        {
            $result = 1 - Math::HypergeometricTest($successInSample + 1, $sizeOfSample, $successInPopulation, $sizeOfPopulation, true);
        }
        else if ($alternative === "twoTailed")
        {
            $currentTableP = Math::HypergeometricTest($successInSample, $sizeOfSample, $successInPopulation, $sizeOfPopulation, false);

            for ($i = 0; $i < $successInPopulation + 1; $i++)
            {
                $tableP = Math::HypergeometricTest($i, $sizeOfSample, $successInPopulation, $sizeOfPopulation, false);

                if ($tableP <= $currentTableP)
                {
                    $result += $tableP;
                }
            }
        }

        return $result;
    }

    static function Enrichment($genesInClassHavingPhenotype, $genesInClass, $genesHavingPhenotype, $genesInBackground)
    {
        if ($genesInClass === 0 || $genesHavingPhenotype - $genesInClassHavingPhenotype === 0 || $genesInBackground - $genesInClass === 0)
        {
            return INF;
        }        
        else
        {
            return ($genesInClassHavingPhenotype / $genesInClass) / (($genesHavingPhenotype - $genesInClassHavingPhenotype) / ($genesInBackground - $genesInClass));
        }
    }

}

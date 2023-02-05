<?php

namespace Cxlblm\PhpRanker;

class Ranker
{
    /**
     * @var float
     */
    public static $epsinon = 1e-7;

    /**
     * @param array<array-key, int|float|string|null> $data
     * @param 'asc'|'desc' $mode
     * @return array<array-key, int<1,max>>
     */
    public static function rank($data, $mode = 'desc')
    {
        self::sort($data, $mode);
        $lastRank = $rank = 1;
        $last = null;
        $first = true;
        $r = [];
        foreach ($data as $key => $datum) {
            if (!$first && !self::equal($datum, $last)) {
                $rank = $lastRank;
            }
            $r[$key] = $rank;
            $lastRank++;
            $last = $datum;
            $first = false;
        }

        return $r;
    }

    /**
     * @param array<array-key, int|float|string|null> $data
     * @param 'asc'|'desc' $mode
     * @return array<array-key, int<1,max>>
     */
    public static function denseRank($data, $mode = 'desc')
    {
        self::sort($data, $mode);
        $rank = 1;
        $last = null;
        $first = true;
        $r = [];
        foreach ($data as $key => $datum) {
            if (!$first && !self::equal($datum, $last)) {
                ++$rank;
            }

            $r[$key] = $rank;
            $last = $datum;
            $first = false;
        }

        return $r;
    }

    /**
     * @param array<array-key, int|float|string|null> $data
     * @param 'asc'|'desc' $mode
     * @return array<array-key, int<1,max>>
     */
    public static function sequence($data, $mode = 'desc')
    {
        self::sort($data, $mode);
        $rank = 1;
        $r = [];
        foreach ($data as $key => $datum) {
            $r[$key] = $rank;
            ++$rank;
        }

        return $r;
    }

    /**
     * @param array{int|string|float} $data
     * @param 'asc'|'desc' $mode
     * @return void
     */
    private static function sort(&$data, $mode = 'desc')
    {
        if ($mode == 'desc') {
            arsort($data);
        } else {
            asort($data);
        }
    }

    /**
     * @param mixed $a
     * @param mixed $b
     * @return bool
     */
    private static function equal($a, $b)
    {
        if (is_numeric($a) && is_numeric($b)) {
            return ($a > $b ? $a - $b : $b - $a) < static::$epsinon;
        }

        return $a == $b;
    }
}

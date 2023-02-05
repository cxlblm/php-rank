<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Cxlblm\PhpRanker\Ranker;

class RankerTest extends TestCase
{
    /**
     * @return void
     */
    public function testIntRankDesc()
    {
        $arr = [
            'a' => 15,
            'b' => 15,
            'c' => 15,
            'd' => 35,
            'e' => 5,
        ];
        $r = Ranker::rank($arr);
        $this->assertSame(
            [
                'd' => 1,
                'a' => 2,
                'b' => 2,
                'c' => 2,
                'e' => 5,
            ],
            $r
        );
    }

    /**
     * @return void
     */
    public function testIntRankDescHasNull()
    {
        $arr = [
            'a' => 15,
            'b' => 15,
            'c' => null,
            'd' => 35,
            'e' => 5,
            'f' => -2,
        ];
        $r = Ranker::rank($arr);
        $this->assertSame(
            [
                'd' => 1,
                'a' => 2,
                'b' => 2,
                'e' => 4,
                'f' => 5,
                'c' => 6,
            ],
            $r
        );
    }

    /**
     * @return void
     */
    public function testIntRankAsc()
    {
        $arr = [
            'a' => 15,
            'b' => 15,
            'c' => 15,
            'd' => 35,
            'e' => 5,
        ];
        $r = Ranker::rank($arr, 'asc');
        $this->assertSame(
            [
                'e' => 1,
                'a' => 2,
                'b' => 2,
                'c' => 2,
                'd' => 5,
            ],
            $r
        );
    }

    /**
     * @return void
     */
    public function testIntRankAscHasNull()
    {
        $arr = [
            'a' => 15,
            'b' => 15,
            'c' => -11,
            'd' => 35,
            'e' => 5,
            'f' => null
        ];
        $r = Ranker::rank($arr, 'asc');
        $this->assertSame(
            [
                'f' => 1,
                'c' => 2,
                'e' => 3,
                'a' => 4,
                'b' => 4,
                'd' => 6,
            ],
            $r
        );
    }

    /**
     * @return void
     */
    public function testIntDenseRankDesc()
    {
        $arr = [
            'a' => 15,
            'b' => 15,
            'c' => 15,
            'd' => 35,
            'e' => 5,
        ];
        $r = Ranker::denseRank($arr);
        $this->assertSame(
            [
                'd' => 1,
                'a' => 2,
                'b' => 2,
                'c' => 2,
                'e' => 3,
            ],
            $r
        );
    }

    /**
     * @return void
     */
    public function testIntDenseRankDesc1()
    {
        $arr = [
            'a' => 15,
            'b' => 13,
            'c' => -1,
            'd' => 35,
            'e' => 5,
        ];
        $r = Ranker::denseRank($arr);
        $this->assertSame(
            [
                'd' => 1,
                'a' => 2,
                'b' => 3,
                'e' => 4,
                'c' => 5,
            ],
            $r
        );
    }

    /**
     * @return void
     */
    public function testIntDenseRankAsc()
    {
        $arr = [
            'a' => 15,
            'b' => 15,
            'c' => 15,
            'd' => 35,
            'e' => 5,
        ];
        $r = Ranker::denseRank($arr, 'asc');
        $this->assertSame(
            [
                'e' => 1,
                'a' => 2,
                'b' => 2,
                'c' => 2,
                'd' => 3,
            ],
            $r
        );
    }

    /**
     * @return void
     */
    public function testIntDenseRankAsc1()
    {
        $arr = [
            'a' => 0,
            'b' => 15,
            'c' => 13,
            'd' => 35,
            'e' => 5,
        ];
        $r = Ranker::denseRank($arr, 'asc');
        $this->assertSame(
            [
                'a' => 1,
                'e' => 2,
                'c' => 3,
                'b' => 4,
                'd' => 5,
            ],
            $r
        );
    }

    /**
     * @return void
     */
    public function testIntSequenceDesc()
    {
        $arr = [
            'a' => 0,
            'b' => 15,
            'c' => 13,
            'd' => 35,
            'e' => 5,
        ];
        $r = Ranker::sequence($arr);
        $this->assertSame(
            [
                'd' => 1,
                'b' => 2,
                'c' => 3,
                'e' => 4,
                'a' => 5,
            ],
            $r
        );
    }

    /**
     * @return void
     */
    public function testIntSequenceDesc1()
    {
        $arr = [
            'a' => 0,
            'b' => 15,
            'c' => 15,
            'd' => 35,
            'e' => 5,
        ];
        $r = Ranker::sequence($arr);
        $this->assertSame(
            [
                'd' => 1,
                'b' => 2,
                'c' => 3,
                'e' => 4,
                'a' => 5,
            ],
            $r
        );
    }

    /**
     * @return void
     */
    public function testIntSequenceAsc()
    {
        $arr = [
            'a' => 0,
            'b' => 15,
            'c' => 13,
            'd' => 35,
            'e' => 5,
        ];
        $r = Ranker::sequence($arr, 'asc');
        $this->assertSame(
            [
                'a' => 1,
                'e' => 2,
                'c' => 3,
                'b' => 4,
                'd' => 5,
            ],
            $r
        );
    }
}
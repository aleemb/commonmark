<?php

/*
 * This file is part of the league/commonmark package.
 *
 * (c) Colin O'Dell <colinodell@gmail.com>
 *
 * Original code based on the CommonMark JS reference parser (http://bitly.com/commonmarkjs)
 *  - (c) John MacFarlane
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace League\CommonMark\Inline\Element;

class Newline extends AbstractBaseInline
{
    const HARDBREAK = 0;
    const SOFTBREAK = 1;

    private $type;

    /**
     * @param int $breakType
     */
    public function __construct($breakType = self::HARDBREAK)
    {
        $this->type = $breakType;
    }

    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }
}

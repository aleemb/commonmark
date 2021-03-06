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

namespace League\CommonMark\Inline\Renderer;

use League\CommonMark\HtmlRenderer;
use League\CommonMark\Inline\Element\AbstractBaseInline;
use League\CommonMark\Inline\Element\Image;

class ImageRenderer implements InlineRendererInterface
{
    /**
     * @param Image $inline
     * @param HtmlRenderer $htmlRenderer
     *
     * @return string
     */
    public function render(AbstractBaseInline $inline, HtmlRenderer $htmlRenderer)
    {
        if (!($inline instanceof Image)) {
            throw new \InvalidArgumentException('Incompatible inline type: ' . get_class($inline));
        }

        $attrs = array();

        foreach ($inline->attributes as $name => $value) {
            $attrs[$name] = $htmlRenderer->escape($value);
        }

        $attrs['src'] = $htmlRenderer->escape($inline->getUrl(), true);

        $alt = $htmlRenderer->renderInlines($inline->getAltText()->getInlines());
        $alt = preg_replace('/\<[^>]*alt="([^"]*)"[^>]*\>/', '$1', $alt);
        $attrs['alt'] = preg_replace('/\<[^>]*\>/', '', $alt);

        if (isset($inline->attributes['title'])) {
            $attrs['title'] = $htmlRenderer->escape($inline->attributes['title'], true);
        }

        return $htmlRenderer->inTags('img', $attrs, '', true);
    }
}

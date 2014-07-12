<?php

/**
 * This file is part of Laravel HTMLMin by Graham Campbell.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace GrahamCampbell\HTMLMin\Minifiers;

use GrahamCampbell\HTMLMin\Interfaces\MinifierInterface;
use Minify_HTML;
use Minify_CSS;
use JSMin;

/**
 * This is the html minifier class.
 *
 * @package    Laravel-HTMLMin
 * @author     Graham Campbell
 * @copyright  Copyright 2013-2014 Graham Campbell
 * @license    https://github.com/GrahamCampbell/Laravel-HTMLMin/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Laravel-HTMLMin
 */
class Html implements MinifierInterface
{
    /**
     * Get the minified value.
     *
     * @param  string  $value
     * @return string
     */
    public function render($value)
    {
        $options = array(
            'cssMinifier' => function ($css) {
                return Minify_CSS::minify($css, array('preserveComments' => false));
            },
            'jsMinifier' => function ($js) {
                return JSMin::minify($js);
            },
            'jsCleanComments' => true
        );

        $value = Minify_HTML::minify($value, $options);

        return $value;
    }
}
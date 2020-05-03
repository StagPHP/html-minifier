<?php
/**
 * StagON Name:        HTML Minifier
 * StagON Text Domain: html-minifier
 * StagON URI:         https://stagphp.io
 * StagON Description: This StagON minifies the HTML output
 * Version:            1.0
 * Author:             StagPHP
 * License:            GPL3
 * License URI:        https://www.gnu.org/licenses/gpl-3.0.html
 */


function sanitize_output($buffer) {
  $search = array(
      '/\>[^\S ]+/s',     // strip white spaces after tags, except space
      '/[^\S ]+\</s',     // strip white spaces before tags, except space
      '/(\s)+/s',         // shorten multiple whitespace sequences
      '/<!--(.|\s)*?-->/' // Remove HTML comments
  );

  $replace = array(
      '>',
      '<',
      '\\1',
      ''
  );

  $buffer = preg_replace($search, $replace, $buffer);

  return $buffer;
}

function minified_output(){
  echo sanitize_output(ob_get_clean());
}

stag_add_action('processed', 'minified_output', TRUE);
<?php

namespace App\BlogPosts;
use Illuminate\Support\Str;

class TableOfContents {

    public $raw;
    public $_toc;
    public $_parsedHtml;

    public function __construct ($html)
    {
        $this->raw = $html;
        $this->_process();
    }

    public function toc ()
    {
        return $this->_toc;
    }

    public function html ()
    {
        return $this->_parsedHtml;
    }

    private function _process ()
    {
        $this->_toc = [];

        $html = preg_replace_callback("/<h([\d])([\w.:=\"\'_\-,;\?\s#\(\)\/]*)>([^<]+)<\/h/", function($matches) {
            $id = Str::random(8);
            $this->_toc[] = (object) [
                'priority' => intval($matches[1]),
                'id' => $id,
                'text' => $matches[3]
            ];
            return '<h'.$matches[1].$matches[2].' id="'.$id.'">'.$matches[3].'</h';
        }, $this->raw);

        $this->_parsedHtml = $html;
    }
}

<?php

namespace JuriBlox\Sdk\Domain\Documents\Entities;

class Preview
{
    /**
     * The HTML of the preview
     *
     * @var string
     */
    private $html;

    /**
     * The CSS of the preview.
     *
     * @var string|null
     */
    private $css;

    /**
     * @return string
     */
    public function getHtml()
    {
        return $this->html;
    }

    /**
     * @return string|null
     */
    public function getCss()
    {
        return $this->css;
    }

    /**
     * @param string $html
     */
    public function setHtml($html)
    {
        $this->html = $html;
    }

    /**
     * @param string|null $css
     */
    public function setCss($css)
    {
        $this->css = $css;
    }
}
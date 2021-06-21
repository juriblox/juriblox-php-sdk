<?php

namespace JuriBlox\Sdk\Domain\Documents\Entities;

use JuriBlox\Sdk\Domain\Documents\Values\TemplateId;

class PreviewRequest
{
    /**
     * Template ID.
     *
     * @var TemplateId
     */
    private $id;

    /**
     * Answers.
     *
     * @var array|QuestionAnswer[]
     */
    private $answers;

    /**
     * Request CSS in response.
     *
     * @var bool
     */
    private $css;

    /**
     * @param TemplateId $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param QuestionAnswer $answer
     */
    public function addAnswer(QuestionAnswer $answer)
    {
        $this->answers[] = $answer;
    }

    /**
     * @param bool $css
     */
    public function setCss($css)
    {
        $this->css = $css;
    }
    
    /**
     * @return TemplateId
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * @return bool
     */
    public function isCss()
    {
        return $this->css;
    }
    
    /**
     * @return array|QuestionAnswer[]
     */
    public function getAnswers()
    {
        return $this->answers;
    }
}
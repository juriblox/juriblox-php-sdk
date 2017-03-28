<?php

namespace JuriBlox\Sdk\Domain\Documents\Values;

use JuriBlox\Sdk\Domain\Documents\Entities\QuestionnaireStep;
use JuriBlox\Sdk\Domain\Documents\Entities\QuestionnaireVariable;

class Questionnaire implements \Iterator, \Countable
{
    /**
     * @var array|QuestionnaireStep[]
     */
    private $steps;

    /**
     * @var array|QuestionnaireVariable[]
     */
    private $variables;

    /**
     * @var int
     */
    private $stepsIndex;

    /**
     * Questionnaire constructor.
     */
    public function __construct()
    {
        $this->clearSteps();
        $this->clearVariables();
    }

    /**
     * Link a step to this questionnaire.
     *
     * @param QuestionnaireStep $step
     */
    public function addStep(QuestionnaireStep $step)
    {
        $this->steps[] = $step;
    }

    /**
     * Link a variable to this questionnaire.
     *
     * @param QuestionnaireVariable $variable
     */
    public function addVariable(QuestionnaireVariable $variable)
    {
        $this->variables[] = $variable;
    }

    /**
     * @return array|QuestionnaireVariable[]
     */
    public function getVariables(): array
    {
        return $this->variables;
    }

    /**
     * Clear the steps linked to this questionnaire.
     */
    public function clearSteps()
    {
        $this->steps = [];
    }

    /**
     * Clear the variables linked to this questionnaire.
     */
    public function clearVariables()
    {
        $this->variables = [];
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return count($this->steps);
    }

    /**
     * {@inheritdoc}
     */
    public function current()
    {
        if (!$this->valid()) {
            return null;
        }

        return $this->steps[$this->stepsIndex];
    }

    /**
     * {@inheritdoc}
     */
    public function key()
    {
        return $this->stepsIndex;
    }

    /**
     * {@inheritdoc}
     */
    public function next()
    {
        ++$this->stepsIndex;
    }

    /**
     * {@inheritdoc}
     */
    public function rewind()
    {
        $this->stepsIndex = 0;
    }

    /**
     * {@inheritdoc}
     */
    public function valid()
    {
        return isset($this->steps[$this->stepsIndex]);
    }
}

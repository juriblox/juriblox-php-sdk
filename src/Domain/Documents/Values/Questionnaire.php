<?php

namespace JuriBlox\Sdk\Domain\Documents\Values;

use Countable;
use JuriBlox\Sdk\Domain\Documents\Entities\QuestionnaireStep;

class Questionnaire implements \Iterator, \Countable
{
    /**
     * @var array|QuestionnaireStep[]
     */
    private $steps;

    /**
     * @var int
     */
    private $stepsIndex;

    /**
     * Questionnaire constructor
     */
    public function __construct()
    {
        $this->clearSteps();
    }

    /**
     * Link a step to this questionnaire
     *
     * @param QuestionnaireStep $step
     */
    public function addStep(QuestionnaireStep $step)
    {
        $this->steps[] = $step;
    }

    /**
     * Clear the steps linked to this questionnaire
     */
    public function clearSteps()
    {
        $this->steps = [];
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return sizeof($this->steps);
    }

    /**
     * {@inheritdoc}
     */
    public function current()
    {
        if (!$this->valid())
        {
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
        $this->stepsIndex++;
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
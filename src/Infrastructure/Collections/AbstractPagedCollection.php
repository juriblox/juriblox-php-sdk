<?php

namespace JuriBlox\Sdk\Infrastructure\Collections;

use JuriBlox\Sdk\Exceptions\CannotParseResponseException;

abstract class AbstractPagedCollection extends AbstractCollection
{
    /**
     * Current page
     *
     * @var int
     */
    protected $currentPage;

    /**
     * Records per page
     *
     * @var int
     */
    protected $recordsPerPage;

    /**
     * Total number of pages
     *
     * @var int
     */
    protected $totalPages;

    /**
     * Total number of records
     *
     * @var int
     */
    protected $totalRecords;

    /**
     * AbstractPagedCollection constructor
     */
    protected function __construct()
    {
        parent::__construct();

        $this->currentPage = 0;
        $this->recordsPerPage = 50;

        $this->totalPages = 0;
        $this->totalRecords = 0;
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return $this->totalRecords;
    }

    /**
     * {@inheritdoc}
     */
    public function key()
    {
        return $this->currentPage * $this->recordsPerPage + $this->index;
    }

    /**
     * {@inheritdoc}
     */
    public function next()
    {
        $this->index++;

        if ($this->index >= sizeof($this->records))
        {
            $this->index = 0;
            $this->records = [];

            $this->currentPage++;

            if ($this->currentPage <= $this->totalPages)
            {
                $this->fetch();
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function rewind()
    {
        parent::rewind();

        $this->currentPage = 1;
    }

    /**
     * Fetch resultset
     */
    protected function fetch()
    {
        $this->setUriQueryParameter('page', $this->currentPage);
        $this->setUriQueryParameter('limit', $this->recordsPerPage);

        $result = $this->endpoint->getDriver()->get($this->getCombinedUri());

        if (!isset($result->{$this->getKey()}))
        {
            throw new CannotParseResponseException(sprintf('The "%s" key does not exist in the result returned by the API', $this->getKey()));
        }

        if (!isset($result->meta->pagination))
        {
            throw new CannotParseResponseException('The meta/pagination key does not exist in the result returned by the API');
        }

        $this->records = $result->{$this->getKey()};

        $this->currentPage = $result->meta->pagination->current_page;
        $this->recordsPerPage = $result->meta->pagination->per_page;

        $this->totalPages = $result->meta->pagination->total_pages;
        $this->totalRecords = $result->meta->pagination->total;
    }
}
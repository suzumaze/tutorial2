<?php
namespace MyVendor\Ticket\Resource\App;

use BEAR\RepositoryModule\Annotation\Cacheable;
use BEAR\Resource\Annotation\JsonSchema;
use BEAR\Resource\ResourceObject;
use Ray\Query\Annotation\AliasQuery;

/**
 * @Cacheable
 */
class Ticket extends ResourceObject
{
    /**
     * @JsonSchema(key="ticket", schema="ticket.json")
     * @AliasQuery("ticket_item_by_id", type="row")
     *
     * @param string $id The unique identifier for a ticket
     */
    public function onGet(string $id) : ResourceObject
    {
        unset($id);

        return $this;
    }
}

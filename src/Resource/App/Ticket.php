<?php
namespace MyVendor\Ticket\Resource\App;

use BEAR\Package\Annotation\ReturnCreatedResource;
use BEAR\RepositoryModule\Annotation\Cacheable;
use BEAR\RepositoryModule\Annotation\Purge;
use BEAR\Resource\Annotation\JsonSchema;
use BEAR\Resource\ResourceObject;
use Koriym\HttpConstants\ResponseHeader;
use Koriym\HttpConstants\StatusCode;
use Ray\AuraSqlModule\Annotation\Transactional;
use Ray\Di\Di\Named;
use Ray\IdentityValueModule\NowInterface;
use Ray\IdentityValueModule\UuidInterface;
use Ray\Query\Annotation\AliasQuery;

/**
 * @Cacheable
 */
class Ticket extends ResourceObject
{
    /**
     * @var callable
     */
    private $createTicket;

    /**
     * @var NowInterface
     */
    private $now;

    /**
     * @var UuidInterface
     */
    private $uuid;

    /**
     * @Named("createTicket=ticket_insert")
     */
    public function __construct(callable $createTicket, NowInterface $now, UuidInterface $uuid)
    {
        $this->createTicket = $createTicket;
        $this->now = $now;
        $this->uuid = $uuid;
    }

    /**
     * @JsonSchema(key="ticket", schema="ticket.json")
     * @AliasQuery("ticket_item_by_id", type="row")
     */
    public function onGet(string $id) : ResourceObject
    {
        unset($id);
    }

    /**
     * @ReturnCreatedResource
     * @Transactional
     * @Purge(uri="app://self/tickets")
     * @Purge(uri="page://self/tickets")
     */
    public function onPost(
        string $title,
        string $description = '',
        string $assignee = ''
    ) : ResourceObject {
        $id = (string) $this->uuid;
        $time = (string) $this->now;
        ($this->createTicket)([
            'id' => $id,
            'title' => $title,
            'description' => $description,
            'assignee' => $assignee,
            'status' => '',
            'created' => $time,
            'updated' => $time,
        ]);
        $this->code = StatusCode::CREATED;
        $this->headers[ResponseHeader::LOCATION] = "/ticket?id={$id}";

        return $this;
    }
}
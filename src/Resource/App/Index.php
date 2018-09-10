<?php
namespace MyVendor\Ticket\Resource\App;

use BEAR\Resource\ResourceObject;

class Index extends ResourceObject
{
    public $body = [
        'message' => 'This is the Tutorial2 REST API',
        'issue' => 'https://github.com/bearsunday/BEAR.ApiDoc/issues',
        '_links' => [
            'self' => [
                'href' => '/',
            ],
            'curies' => [
                'href' => 'rels/{rel}.html',
                'name' => 'kt',
                'templated' => true
            ],
            'kt:ticket' => [
                'href' => '/tickets/{id}',
                'title' => 'Ticket',
                'templated' => true
            ],
            'kt:tickets' => [
                'href' => '/tickets',
                'title' => 'The collection of ticket'
            ]
        ]
    ];

    public function onGet()
    {
        return $this;
    }
}

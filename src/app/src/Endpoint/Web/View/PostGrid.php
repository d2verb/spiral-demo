<?php

namespace App\Endpoint\Web\View;

use Spiral\DataGrid\GridSchema;
use Spiral\DataGrid\Specification\Filter\Equals;
use Spiral\DataGrid\Specification\Pagination\PagePaginator;
use Spiral\DataGrid\Specification\Sorter\Sorter;
use Spiral\DataGrid\Specification\Value\StringValue;
use Spiral\Prototype\Annotation\Prototyped;

#[Prototyped(property: 'postGrid')]
final class PostGrid extends GridSchema
{
    public function __construct()
    {
        $this->addFilter('author', new Equals('author.id', new StringValue()));

        $this->addSorter('id', new Sorter('id'));
        $this->addSorter('author', new Sorter('author.id'));

        $this->setPaginator(new PagePaginator(10, [10, 20, 50]));
    }
}

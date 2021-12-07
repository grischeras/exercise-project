<?php declare(strict_types=1);

namespace App\Api\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

abstract class AbstractApiController extends AbstractController
{
    /**
     * @var array
     */
    protected array $arResult = [];
}
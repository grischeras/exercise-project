<?php declare(strict_types=1);

namespace App\Api\Filter;

use ApiPlatform\Core\Api\FilterInterface;

class CustomFilter implements FilterInterface
{
    protected ?array $properties;
    protected ?array $options;

    /**
     * CustomFilter constructor.
     * @param array|null $properties
     * @param array|null $options
     */
    public function __construct(array $properties = null, array $options=null)
    {
        $this->properties = $properties;
        $this->options = $options;
    }

    /**
     * @param string $resourceClass
     * @return array
     */
    public function getDescription(string $resourceClass): array
    {
        $filters = [];
        foreach($this->properties as $key => $property) {
            $type = "string";
            if(isset($this->options[$key]['type'])){
                $type=$this->options[$key]['type'];
            }

            $schema=[];
            if(isset($this->options[$key])){
                foreach($this->options[$key] as $k2 => $v2){
                    $schema[$k2] = $v2;
                }
            }

            $filters[$key] = [
                'property' => $key,
                'required' => false,
                'type' => $type,
                'openapi' => [
                    'schema'=> $schema
                ],
            ];
        }
        return $filters;
    }

}
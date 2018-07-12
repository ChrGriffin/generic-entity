<?php

namespace ChrGriffin;

class GenericEntity
{
    /**
     * Entity attributes.
     *
     * @var array
     */
    protected $attributes;

    /**
     * GenericEntity constructor.
     *
     * @param array $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
    	$this->attributes = (array)$attributes;
    }

    /**
     * GenericEntity setter.
     *
     * @param mixed $name
     * @return void
     */
    public function __set($name, $value)
    {
    	if(isset($this->attributes[$name])) {
    		$this->attributes[$name] = $value;
    	}
    	elseif(isset($this->{$name})) {
    		$this->{$name} = $value;
    	}
    }

    /**
     * GenericEntity getter.
     *
     * @param mixed $name
     * @return mixed
     */
    public function __get($name)
    {
    	if(isset($this->attributes[$name])) {
    		return $this->attributes[$name];
    	}

    	if(isset($this->{$name})) {
    		return $this->{$name};
    	}

    	return null;
    }

    /**
     * GenericEntity issetter.
     *
     * @param mixed $name
     * @return bool
     */
    public function __isset($name)
    {
    	return isset($this->attributes[$name])
    		|| isset($this->{$name});
    }

    /**
     * GenericEntity unsetter.
     *
     * @param mixed $name
     * @return bool
     */
    public function __unset($name)
    {
    	if(isset($this->attributes[$name])) {
    		unset($this->attributes[$name]);
    	}

    	if(isset($this->{$name})) {
    		unset($this->{$name});
    	}
    }

    /**
     * Return the entity attributes as an array.
     *
     * @return array
     */
    public function toArray() : array
    {
        return $this->mapToArray($this->attributes);
    }

    /**
     * Return the given value parsed to an array.
     *
     * @param mixed $value
     * @return mixed
     */
    private function mapToArray($value)
    {
        if(is_object($value)) {
            $value = get_object_vars($value);
        }

        return is_array($value) ? array_map(__METHOD__, $value) : $value;
    }
}
<?php

namespace App\Base\Traits\Views;

use Illuminate\Support\Str;

trait Path
{
    /**
     * the exploded namespace (from the class)
     * please note that: this method should be private but I have set it to protected
     * due to testing purposes for phpunit:
     * (1) it doesn't allow setting namespace for the mocked class as we get the class directly
     *     like ClassName but we want it like so: Core\Module\Controllers\Web\AnyNameController'
     * (2) we can't mock a private method but we can mock a protected method
     *
     * @codeCoverageIgnore
     * @return string[]
     */
    protected function getExplodedNamespace()
    {
        return explode('\\', get_class($this));
    }

    private function setNamespace()
    {
        $exploded_namespace = $this->getExplodedNamespace();
        $this->namespace = Str::snake($exploded_namespace[0]) . '#' . Str::snake($exploded_namespace[1]) . '#' . Str::snake($exploded_namespace[2]);
    }

    /**
     * get the namespace of the views
     *
     * @return string
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * set the directory that will contain the views files from an array
     *
     * @param int $offset
     * @return void
     */
    private function setDirectory($offset = 2)
    {
        $array = array_slice($this->getExplodedNamespace(), $offset);
        $this->directory .= str_replace('_controller', '', Str::snake($array[0])).'.';
        $this->directory .= str_replace('_controller', '', Str::snake($array[2]));
    }

    public function getDirectory()
    {
        return $this->directory;
    }

    /**
     * set the full path to the view directory
     *
     * @param null|string $directory
     * @param null|string $namespace
     * @return void
     */
    protected function setPath($directory = null, $namespace = null)
    {
        $this->namespace = $namespace ?? $this->namespace;
        $this->directory = $directory ?? $this->directory;
        $this->path = $this->directory . '.';
    }

    public function getPath()
    {
        return $this->path;
    }

    private function setupView()
    {
        $this->setNamespace();
        $this->setDirectory();
        $this->setPath();
    }
}

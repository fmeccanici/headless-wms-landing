<?php

namespace HomeDesignShops\LaravelDdd\Doctrine;

use Doctrine\Persistence\Mapping\Driver\DefaultFileLocator;
use Doctrine\Persistence\Mapping\MappingException;

class MappingFileLocator extends DefaultFileLocator
{
    /**
     * @inheritDoc
     */
    public function findMappingFile($className)
    {
        $fileName = class_basename($className) . $this->fileExtension;

        // Check whether file exists
        foreach ($this->paths as $path) {
            if (is_file($path . DIRECTORY_SEPARATOR . $fileName)) {
                return $path . DIRECTORY_SEPARATOR . $fileName;
            }
        }

        throw MappingException::mappingFileNotFound($className, $fileName);
    }
}
<?php

namespace{

    use Inferno\InfernoElemental\Element\ElementGalleryExtension;
    use SilverStripe\ORM\DataExtension;

    class GalleryImageExtension extends DataExtension{

        private static $has_one = array(
        'ElementMyGalleryExtension' => ElementGalleryExtension::class,
        );
    }
}
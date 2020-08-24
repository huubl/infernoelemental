<?php

namespace{

    use Inferno\InfernoElemental\Element\ElementGalleryExtension;
    use Inferno\InfernoElemental\Element\ElementMyGalleryExtension;
    use SilverStripe\ORM\DataExtension;

    class GalleryImageExtension extends DataExtension{

        private static $has_one = array(
        'ElementMyGalleryExtension' => ElementMyGalleryExtension::class,
        );
    }
}
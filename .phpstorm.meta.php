<?php

namespace PHPSTORM_META {

    use App\Services\CollateService;
    use App\Services\CompareService;
    use App\Services\SegmentDataProvider;

    override(\app(0), map([
        SegmentDataProvider::class => SegmentDataProvider::class,
        CompareService::class => CompareService::class,
        CollateService::class => CollateService::class,
    ]));

}

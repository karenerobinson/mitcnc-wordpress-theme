<?php

namespace MITCNC_Theme\Enums;

// TODO Use Enum when we upgrade to PHP 8.1
abstract class DateFilter
{
    const TODAY = 'today';
    const TOMORROW = 'tomorrow';
    const THIS_WEEK = 'this_week';
    const THIS_WEEKEND = 'this_weekend';
    const THIS_MONTH = 'this_month';
    const NEXT_MONTH = 'next_month';
    const NEXT_THREE_MONTHS = 'next_three_months';
    const PAST_THREE_MONTHS = 'past_three_months';
    const PAST = 'past';
}

abstract class EventTaxonomy
{
    const ACCESS_TYPE = 'event-access-types';
    const AUDIENCE = 'event-audience';
    const CATEGORY = 'event-cat';
    const LOCATION = 'event-locations';
    const PROGRAM = 'event-programs';
}

abstract class PageID
{
    const EVENT_LISTING = 414;
    const GET_INVOLVED = 251;
}

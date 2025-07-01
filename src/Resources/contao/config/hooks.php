<?php

$GLOBALS['TL_HOOKS']['getCountries'][] = ['Webinteger\WiBooking\Callbacks\CountryOptionsCallback', 'onGetCountries'];

<?php

return [
    'current-health-decimal-points' => 2,
    'default-health' => number_format(100, config('animals.current-health-decimal-points')),
];
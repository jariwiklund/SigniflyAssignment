<?php

namespace SigniflyAssignment\Utils;


class Util
{
    public static function UuidRegexPattern(): string
    {
        return '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}';
    }
}
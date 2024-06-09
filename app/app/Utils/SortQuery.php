<?php

namespace App\Utils;

use Illuminate\Support\Str;

/**
 * Class SortQuery
 */
class SortQuery
{
    public const ASC = 'asc';

    public const DESC = 'desc';

    public const SIGN_ASC = '';

    public const SIGN_DESC = '-';

    public const SIGNS = [
        self::ASC => self::SIGN_ASC,
        self::DESC => self::SIGN_DESC
    ];

    /**
     * @param string $sortValue
     *
     * @return array
     */
    public static function parse(string $sortValue): array
    {
        $parsedResult = [];

        if (!empty($sortValue)) {
            $sorts = explode(',', $sortValue);

            foreach ($sorts as $sortColumn) {
                $sortDirection = Str::startsWith($sortColumn, self::SIGN_DESC) ? self::DESC : self::ASC;
                $sortColumn = ltrim($sortColumn, self::SIGN_DESC);
                $parsedResult[$sortColumn] = $sortDirection;
            }
        }

        return $parsedResult;
    }

    /**
     * @param array $columns
     *
     * @return string
     */
    public static function build(array $columns): string
    {
        $queryValue = [];

        foreach ($columns as $column => $direction) {
            $queryValue[] = self::SIGNS[$direction] . $column;
        }

        return implode(',', $queryValue);
    }

    /**
     * @param array  $columns
     * @param string $column
     * @param string $defaultValue
     *
     * @return array
     */
    public static function invert(array $columns, string $column, string $defaultValue = self::DESC): array
    {
        if (!isset($columns[$column])) {
            $columns[$column] = $defaultValue;
        }

        $columns[$column] = match ($columns[$column]) {
            self::ASC => self::DESC,
            self::DESC => self::ASC,
        };

        return $columns;
    }
}

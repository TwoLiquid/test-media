<?php

/**
 * This is a file with global helper functions
 */

if (!function_exists('generateFullStorageLink')) {

    /**
     * @param string $fileUrl
     *
     * @return string
     */
    function generateFullStorageLink(
        string $fileUrl
    ): string
    {
        return config('app.url') . 'storage/' . $fileUrl;
    }
}

if (!function_exists('getSizeFromBase64String')) {

    /**
     * @param string $base64string
     *
     * @return float
     */
    function getSizeFromBase64String(
        string $base64string
    ) : float
    {
        $lengthInCharacters = strlen($base64string);
        $paddingCharacters = substr($base64string, -4);
        $numberOfPaddingCharacters = substr_count($paddingCharacters, '=');

        return (3 * ($lengthInCharacters / 4)) - $numberOfPaddingCharacters;
    }
}

if (!function_exists('getMinimizedFilePath')) {

    /**
     * @param string $filePath
     *
     * @return string
     */
    function getMinimizedFilePath(
        string $filePath
    ) : string
    {
        return str_replace('.', '_min.', $filePath);
    }
}

if (!function_exists('getMergedIds')) {

    /**
     * @param int $authId
     * @param array|null $authIds
     *
     * @return array
     */
    function getMergedIds(
        int $authId,
        ?array $authIds
    ) : array
    {
        return array_merge(
            [$authId],
            $authIds ?: []
        );
    }
}

if (!function_exists('explodeUrlStrings')) {

    /**
     * @param string $array
     *
     * @return array
     */
    function explodeUrlStrings(
        string $array
    ) : array
    {
        $ids = [];

        foreach (explode(',', $array) as $id) {
            $ids[] = $id;
        }

        return $ids;
    }
}


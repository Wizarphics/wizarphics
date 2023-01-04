<?php

/**
 * The goal of this file is to allow developers a location
 * where they can overwrite core procedural functions and
 * replace them with their own. This file is loaded during
 * the bootstrap process and is called during the framework's
 * execution.
 *
 * This can be looked at as a `master helper` file that is
 * loaded early on, and may also contain additional functions
 * that you'd like to use throughout your entire application
 *
 * @see: https://github.com/Wizarphics/WizarFrameWork/
 */

use wizarphics\wizarframework\Application;

Sage::$theme = Sage::THEME_SOLARIZED_DARK;


if (!function_exists('clean_path')) {
    /**
     * A convenience method to clean paths for
     * a nicer looking output. Useful for exception
     * handling, error logging, etc.
     */
    function clean_path(string $path): string
    {
        // Resolve relative paths
        $path = realpath($path) ?: $path;

        switch (true) {
            case strpos($path, ROOT_DIR) === 0:
                return 'ROOT_DIR' . DIRECTORY_SEPARATOR . substr($path, strlen(ROOT_DIR));

            case strpos($path, CORE_DIR) === 0:
                return 'CORE_DIR' . DIRECTORY_SEPARATOR . substr($path, strlen(CORE_DIR));

            case strpos($path, PUBLICPATH) === 0:
                return 'PUBLICPATH' . DIRECTORY_SEPARATOR . substr($path, strlen(PUBLICPATH));

            case defined('VENDORPATH') && strpos($path, VENDORPATH) === 0:
                return 'VENDORPATH' . DIRECTORY_SEPARATOR . substr($path, strlen(VENDORPATH));

            case strpos($path, ROOT_DIR) === 0:
                return 'ROOT_DIR' . DIRECTORY_SEPARATOR . substr($path, strlen(ROOT_DIR));

            default:
                return $path;
        }
    }
}


if(!function_exists('yieldSection')){
    /**
     * A convenience method to yield a section
     */
    function yieldSection(string $sectionName): void
    {
        Application::$app->view->yieldSection($sectionName);
    }
}

if(!function_exists('section')){
    /**
     * A convenience method to start a view section
     */
    function section(string $sectionName): void
    {
        Application::$app->view->section($sectionName);
    }
}

if (!function_exists('endSection')) {
    /**
     * A convenience method to end a view section
     */
    function endSection(): void
    {
        Application::$app->view->endSection();
    }

}
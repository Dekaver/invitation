<?php

if (!function_exists('get_theme_path')) {
    /**
     * Get the theme path for a view
     *
     * @param string|null $theme
     * @param string $view
     * @return string
     */
    function get_theme_path(?string $theme = null, string $view = 'show'): string
    {
        return app(\App\Services\ThemeService::class)->getThemePath($theme, $view);
    }
}

if (!function_exists('theme_class')) {
    /**
     * Get CSS class for theme styling
     *
     * @param string|null $theme
     * @return string
     */
    function theme_class(?string $theme = null): string
    {
        $theme = app(\App\Services\ThemeService::class)->validateTheme($theme);
        return "theme-{$theme}";
    }
}

<?php

namespace App\Services;

class ThemeService
{
    /**
     * List of available themes
     */
    protected const AVAILABLE_THEMES = ['classic', 'modern', 'elegant'];

    /**
     * Get the view name for a wedding theme
     *
     * @param string|null $theme
     * @param string $view
     * @return string
     */
    public function getThemePath(?string $theme, string $view = 'show'): string
    {
        $theme = $this->validateTheme($theme);
        return "themes.{$theme}.{$view}";
    }

    /**
     * Validate and return a valid theme, fallback to default
     *
     * @param string|null $theme
     * @return string
     */
    public function validateTheme(?string $theme): string
    {
        if ($theme && in_array($theme, self::AVAILABLE_THEMES)) {
            return $theme;
        }

        return 'classic'; // Default theme
    }

    /**
     * Get all available themes
     *
     * @return array
     */
    public function getAvailableThemes(): array
    {
        return self::AVAILABLE_THEMES;
    }

    /**
     * Check if a theme exists
     *
     * @param string $theme
     * @return bool
     */
    public function themeExists(string $theme): bool
    {
        return in_array($theme, self::AVAILABLE_THEMES);
    }
}

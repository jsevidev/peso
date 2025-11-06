<?php
// icon_manager.php - Create this file in your includes directory

class IconManager {
    private static $icons = [];
    
    public static function initialize() {
        // Define all icons here once
        self::$icons = [
            // Navigation icons
            'dashboard' => 'fa-solid fa-gauge-high',
            'applicants' => 'fa-solid fa-users',
            'employers' => 'fa-solid fa-building',
            'job_posting' => 'fa-solid fa-file-lines',
            'applications' => 'fa-solid fa-file-signature',
            'job_fair' => 'fa-solid fa-calendar-days',
            'announcements' => 'fa-solid fa-bullhorn',
            'logout' => 'fa-solid fa-arrow-right-from-bracket',
            
            // Action icons
            'add' => 'fa-solid fa-plus',
            'search' => 'fa-solid fa-magnifying-glass',
            'filter' => 'fa-solid fa-filter',
            'notification' => 'fa-solid fa-bell',
            'view' => 'fa-solid fa-eye',
            'edit' => 'fa-solid fa-pen-to-square',
            'upload' => 'fa-solid fa-upload',
            'toggle_on' => 'fa-solid fa-toggle-on',
            'toggle_off' => 'fa-solid fa-toggle-off',
            
            // Status icons
            'active' => 'fa-solid fa-circle-check',
            'inactive' => 'fa-solid fa-circle-xmark'
        ];
    }
    
    public static function getIcon($iconName, $size = '', $color = '') {
        if (!isset(self::$icons[$iconName])) {
            return '';
        }
        
        $classes = self::$icons[$iconName];
        
        // Add size class if specified
        if ($size) {
            $classes .= " fa-{$size}";
        }
        
        // Build style attribute for color
        $style = '';
        if ($color) {
            $style = " style=\"color: {$color};\"";
        }
        
        return "<i class=\"{$classes}\"{$style}></i>";
    }
    
    public static function renderIcon($iconName, $size = '', $color = '', $alt = '') {
        $iconHtml = self::getIcon($iconName, $size, $color);
        
        if ($alt) {
            $iconHtml = str_replace('></i>', " alt=\"{$alt}\"></i>", $iconHtml);
        }
        
        return $iconHtml;
    }
}

// Initialize the icon manager
IconManager::initialize();
?>
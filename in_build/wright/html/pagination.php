<?php
// no direct access
defined('_JEXEC') or die('Restricted access');


function pagination_list_render($list)
{
    // Initialize variables
    $lang =& JFactory::getLanguage();
    $html = "<div class=\"pagination\">";
    $html .= "<ul>";
    
    // Reverse output rendering for right-to-left display
    if($lang->isRTL()) {
        $html .= $list['start']['data'];
        $html .= $list['previous']['data'];
        $list['pages'] = array_reverse( $list['pages'] );
        
        foreach( $list['pages'] as $page ) {
        
            if($page['data']['active']) {
               //$html .= '<strong>';
            }
        
            $html .= $page['data'];
        
            if($page['data']['active']) {
                //$html .= '</strong>';
            }
        }
        
        $html .= $list['next']['data'];
        $html .= $list['end']['data'];
    }
    else {
        $html .= $list['start']['data'];
        $html .= $list['previous']['data'];
        
        foreach( $list['pages'] as $page ) {
            if($page['data']['active']) {
                 // $html .= '<strong>';
            }
            
            $html .= $page['data'];
            
            if($page['data']['active']) {
                // $html .= '</strong>';
            }
        }
    
        $html .= $list['next']['data'];
        $html .= $list['end']['data'];
    }
    
    $html .= "</ul>";
    $html .= "</div>";
    return $html;
}
     
function pagination_item_active(&$item) {
    return "<li> <a href=\"" . $item->link . "\" title=\"".$item->text."\">".$item->text."</a></li>";
}
     
function pagination_item_inactive(&$item) {
    return "<li class=\"disabled\"><a href=\"/\">".$item->text."</a></li>";
}

?>
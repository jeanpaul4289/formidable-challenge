
<div class="frm_wrap">
    <div id="frm_top_bar">
        <div id="frm-publishing">
        </div>
        <a href="#" class="frm-header-logo">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 599.68 601.37" width="35" height="35">
                <path fill="#f05a24" d="M289.6 384h140v76h-140z"></path>
                <path fill="#4d4d4d" d="M400.2 147h-200c-17 0-30.6 12.2-30.6 29.3V218h260v-71zM397.9 264H169.6v196h75V340H398a32.2 32.2 0 0 0 30.1-21.4 24.3 24.3 0 0 0 1.7-8.7V264zM299.8 601.4A300.3 300.3 0 0 1 0 300.7a299.8 299.8 0 1 1 511.9 212.6 297.4 297.4 0 0 1-212 88zm0-563A262 262 0 0 0 38.3 300.7a261.6 261.6 0 1 0 446.5-185.5 259.5 259.5 0 0 0-185-76.8z"></path>
            </svg>
        </a>
        <div class="frm_top_left frm_top_wide">
            <h1>
                Formidable Challenge						
                <a href="#" class="button button-primary frm-button-primary">Refresh</a>
            </h1>
        </div>
        <div style="clear:right;"></div>
    </div>
    <div class="wrap">
        <ul class="subsubsub">
            <li class="published">
                <a href="#" class="current">My Forms <span class="count">(<?php $frmchal_list->get_items_count(); ?>)</span></a>
            </li>
        </ul>
        <form id="posts-filter" method="get">
            <?php $frmchal_list->display(); ?>
        </form>
    </div>
</div>
<form role="search" method="get" id="searchform" class="sidebar-search  clearfix" action="<?php echo home_url( '/' ); ?>">
    <input type="search" class="form-control" placeholder="<?php echo esc_attr_x( 'Search', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
    <button class="btn" type="submit"><i class="fa fa-search"></i></button>
</form>
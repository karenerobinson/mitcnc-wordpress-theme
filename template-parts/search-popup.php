<?php
global $assets_uri;
?>
<div id="myNav" class="search-overlay">
    <nav class="search-nav">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-8">
                    <a href="<?php echo esc_html(home_url()); ?>" class="logo"><img src="<?php echo esc_url($assets_uri); ?>/images/newsletter/logo-mitcnc-white.png" alt="" height="40"></a>
                </div>
                <div class="col-md-16">
                    <ul>
                        <li>
                            <label>
                                <a href="javascript:void(0);" class="search-icon"><img src="<?php echo esc_url($assets_uri); ?>/images/icons/white-search-icon.svg" alt=""  width="18px"></a>
                                <input type="text" placeholder="what are you looking for today?"  value="" name="s" title="Search for:" id="searchInput">
                                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><img src="<?php echo esc_url($assets_uri); ?>/images/icons/cross-icon.svg" alt=""></a>
                            </label>
                        </li>
                            
                    </ul>
                </div>
                
            </div>    
        </div>                    
    </nav>
    <div class="overlay-content">
        <div class="search-container">
            <div class="loader" id="search_loader" style="display: none;"></div>
            <div class="container" id="search_result_container" style="display: none;">
                <div class="row">
                    <div class="col-24">
                        <div class="search-results">
                            <h2 class="bordered" style=""><span id="search-result-count">0</span> results found</h2>
                        </div>
                    </div>
                    
                    <div class="col-md-24 col-lg-12 pull-lg-14">
                        <div class="search-results">
                            <ul id="search-results-posts"></ul>
                        </div>
                    </div>
                    <div class="col-lg-11 col-md-24 offset-lg-1 offset-md-0">
                        <div class="speaker-search-result">
                            <div class="row" id="search-results-users"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div id="loadMoreSearchResultContainer" style="display: none;"><button id="loadMoreSearchResult" onclick="loadMoreSearchResult('10')">Load More</button></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

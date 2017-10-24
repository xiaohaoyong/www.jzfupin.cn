<?php include $this->_include('header.html'); ?>
<script> 
$(function(){
	viewModel.loadjcsclist(<?php echo $cid; ?>);//初始化
});
</script>
<div class="bd">
    <div class="weui_search_bar" id="search_bar">
        <form class="weui_search_outer">
            <div class="weui_search_inner">
                <i class="weui_icon_search"></i>
                <input type="search" class="weui_search_input" id="search_input" placeholder="请您输入您要想了解的资讯" required="">
                <a href="javascript:" class="weui_icon_clear" id="search_clear"></a>
            </div>
            <!--label for="search_input" class="weui_search_text" id="search_text">
                <i class="weui_icon_search"></i>
                <span>请您输入您要想了解的资讯</span>
            </label-->
        </form>
        <a href="javascript:" class="weui_search_cancel" id="search_cancel">取消</a>
    </div>
</div>

<div class="weui_cells weui_cells_access nomtop" id="c_list"></div>
<script id="c_list_tmpl" type="text/x-jquery-tmpl"> 
    <a class="weui_cell" href="${url}" data-id="${id}">
        <div class="weui_cell_bd weui_cell_primary">
            <p>${title}</p>
        </div>
        <div class="weui_cell_ft"></div>
    </a>
</script>
<?php include $this->_include('footer.html'); ?>
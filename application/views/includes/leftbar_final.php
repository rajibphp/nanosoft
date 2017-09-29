<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">

        <div id="sidebar-menu">
            <ul class="sidebar-menu">
                <li>
                    <a href="<?php echo site_url('dashboard'); ?>">
                        <span style="color: #E26F26">
                        <i class="zmdi zmdi-view-dashboard"></i>
                        <span>Dashboard</span></span> 
                    </a>
                </li>
                <?php
                    if($this->session->userdata('login_role') != 6){
                        $this->load->module('menu');
                    $parentMenu = $this->menu->parentMenu();
                    $getMenu = $this->menu->getMenu();
                    foreach($parentMenu as $pMenu){ ?>
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect">
                                <span style="color: #E26F26">
                                    <i class="zmdi zmdi-album"></i>
                                    <span><?php echo $pMenu['name']; ?></span>
                                    <span class="menu-arrow"></span>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <?php 
                                    foreach($getMenu as $menu){ 
                                        if($menu['parentMenu'] == $pMenu['id']){ 
                                            if($menu['is_parent']==0){ ?>
                                                <li>
                                                    <a href="<?php echo site_url($menu['url']); ?>">
                                                        <i class="zmdi zmdi-folder-outline"></i>
                                                        <span><?php echo $menu['name']; ?></span> 
                                                    </a>
                                                </li>
                                            <?php }else{ ?>                           
                                                <li class="has_sub">
                                                    <a href="javascript:void(0);" class="waves-effect">
                                                        <span style="color: #006400;">
                                                            <i class="zmdi zmdi-folder-outline"></i>
                                                            <span style="font-size: 13px;"><?php echo $menu['name']; ?></span> 
                                                            <span class="menu-arrow"></span>                                    
                                                        </span>
                                                    </a>
                                                    <ul class="treeview-menu">
                                                        <?php 
                                                            if(!empty($menu[0])){
                                                                foreach($menu[0] as $row0){ ?>
                                                                    <li>
                                                                        <a style="color: #006400; font-size: 13px;" href="<?php echo site_url($row0['url']); ?>">
                                                                            <?php echo $row0['title']; ?>
                                                                        </a>
                                                                    </li>
                                                            <?php }
                                                            }
                                                            if(!empty($menu[1])){
                                                                foreach($menu[1] as $row1){ ?>
                                                                     <li class="has_sub">
                                                                        <?php 
                                                                            if($row1['url'] !=''){ ?>
                                                                                <a href="<?php echo site_url($row1['url']); ?>" class="waves-effect">
                                                                                    <i class="zmdi zmdi-settings"></i>
                                                                                    <span> <?php echo $row1['name']; ?> </span>
                                                                                </a>
                                                                            <?php }else{ ?>
                                                                            <a href="javascript:void(0);" class="waves-effect">
                                                                                <span style="color: #000000;">
                                                                                    <i class="zmdi zmdi-settings"></i>
                                                                                    <span style="font-size: 13px;"><?php echo $row1['name']; ?></span>
                                                                                    <span class="menu-arrow"></span>
                                                                                </span>
                                                                            </a>
                                                                        <?php }
                                                                        ?>

                                                                        <ul class="treeview-menu">
                                                                        <?php 
                                                                            foreach($row1[0] as $subRow1){ ?>
                                                                                <li>
                                                                                    <a style="color: #000000; font-size: 13px;" href="<?php echo site_url($subRow1['url']); ?>">
                                                                                        <?php echo $subRow1['title']; ?>
                                                                                    </a>
                                                                                </li>
                                                                            <?php }
                                                                        ?>
                                                                        </ul>
                                                                    </li>
                                                            <?php }
                                                            }
                                                        ?>
                                                    </ul>
                                                </li>
                                        <?php }
                                        }                                   
                                    }
                                ?>
                            </ul>
                        </li>
                    <?php  }
                    }
                ?>                                        
            </ul>
            <div class="clearfix"></div>
        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>
    </div>
</div>
<script>
    $(document).ready(function(){
        var url = window.location;
        $('ul.sidebar-menu a').filter(function() {
            return this.href == url;
        }).parent().addClass('active');
        $('ul.treeview-menu a').filter(function() {
            return this.href == url;
        }).parentsUntil(".sidebar-menu > .treeview-menu").addClass('active');
        $('ul.treeview-menu a').filter(function() {
            return this.href == url;
        }).closest('ul.treeview-menu a').css({'background-color': '#64B0F2'});
    })
</script>
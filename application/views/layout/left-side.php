<?php
    $photo = $this->session->userdata('photo');
    $role_id = $this->session->userdata('role_id');
    $path = '';
    $realpath='';
    if($role_id == CHILDREN){ $path = 'children'; }
    elseif($role_id == MONITER){ $path = 'moniter'; }
    elseif($role_id == LIBRARIN){ $path = 'librarin'; }
    else{ $path = 'employee'; }
    if ($photo != '')
        $realpath=UPLOAD_PATH.'/'.$path.'-photo/'.$photo;
    else 
        $realpath=IMG_URL.'/img.png';       
?>
<div class="col-md-3 left_col">
  <div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
      <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>HA-0335</span></a>
    </div>

    <div class="clearfix"></div>

    <!-- menu profile quick info -->
    <div class="profile">
      <div class="profile_info">
        <span>Welcome,</span>
        <h2><?=$this->session->userdata('name');?></h2>
      </div>
    </div>
    <!-- /menu profile quick info -->

    <br />
    <div class="clearfix"></div>

    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">
          <li><a href="<?php echo site_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> <?php echo $this->lang->line('dashboard'); ?></a>  </li>
          <?php 
            if(has_permission(VIEW, 'setting', 'setting') || 
               has_permission(VIEW, 'setting', 'sms') ||
               has_permission(VIEW, 'setting', 'email')){ ?>
                <li><a><i class="fa fa-gears"></i> <?php echo $this->lang->line('setting'); ?> <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">                            
                    <?php if(has_permission(VIEW, 'setting', 'setting')){ ?>
                        <li><a href="<?php echo site_url('setting'); ?>"><?php echo $this->lang->line('general'); ?> <?php echo $this->lang->line('setting'); ?></a></li>
                    <?php } ?>
                    
                </ul>
            </li>
            <?php } ?>

            <?php 
                    if(has_permission(VIEW, 'administrator', 'role') || 
                       has_permission(VIEW, 'administrator', 'permission') || 
                       has_permission(VIEW, 'administrator', 'user') || 
                       has_permission(EDIT, 'administrator', 'password') || 
                       has_permission(VIEW, 'administrator', 'usercredential')){ ?>    
                        <li><a><i class="fa fa-user"></i> <?php echo $this->lang->line('administrator'); ?> <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <?php if(has_permission(VIEW, 'administrator', 'role')){ ?>   
                                    <li><a href="<?php echo site_url('administrator/role'); ?>"> <?php echo $this->lang->line('user_role'); ?> (ACL)</a></li> 
                                <?php } ?>
                                <?php if(has_permission(VIEW, 'administrator', 'permission')){ ?> 
                                    <li><a href="<?php echo site_url('administrator/permission'); ?>"><?php echo $this->lang->line('role_permission'); ?> (ACL)</a></li> 
                                 <?php } ?>
                                <?php if(has_permission(VIEW, 'administrator', 'user')){ ?>   
                                    <li><a href="<?php echo site_url('administrator/user'); ?>"><?php echo $this->lang->line('manage_user'); ?></a></li> 
                                 <?php } ?>
                                <?php if(has_permission(EDIT, 'administrator', 'password')){ ?>   
                                    <li><a href="<?php echo site_url('administrator/password'); ?>"><?php echo $this->lang->line('reset_user_password'); ?></a></li> 
                                 <?php } ?>
                                <?php if(has_permission(VIEW, 'administrator', 'usercredential')){ ?>   
                                    <li><a href="<?php echo site_url('administrator/usercredential/index'); ?>"><?php echo $this->lang->line('user'); ?> <?php echo $this->lang->line('credential'); ?></a></li> 
                                <?php } ?>     
                                </ul>
                        </li>
                    <?php }
                    if(has_permission(VIEW,'children','children')){
                    ?>
                    <li><a href="<?php echo site_url('children'); ?>"><i class="fa fa-user"></i>Enfants</a></li>

                    <?php
                    }
                    if($role_id == CHILDREN){ 
                      if(has_permission(VIEW, 'library', 'ebook')){ ?>
                          <li><a href="<?php echo site_url('library/ebook/index'); ?>"><?php echo $this->lang->line('e_book'); ?></a></li>
                    <?php } }else{  
                    if(has_permission(VIEW, 'library', 'book') || 
                            has_permission(VIEW, 'library', 'member') || 
                            has_permission(VIEW, 'library', 'issue') ||   
                            has_permission(VIEW, 'library', 'ebook')){ ?>        
                        <li><a><i class="fa fa-book"></i> <?php echo $this->lang->line('library'); ?> <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <?php if(has_permission(VIEW, 'library', 'book')){ ?>
                                    <li><a href="<?php echo site_url('library/book/index/'); ?>"><?php echo $this->lang->line('book'); ?></a></li>
                                <?php } ?>
                                <?php if(has_permission(VIEW, 'library', 'member')){ ?>
                                    <li><a href="<?php echo site_url('library/member/index/'); ?>"><?php echo $this->lang->line('library'); ?> <?php echo $this->lang->line('member'); ?></a></li>
                                <?php } ?>
                                <?php if(has_permission(VIEW, 'library', 'issue')){ ?>
                                    <li><a href="<?php echo site_url('library/issue/index'); ?>"><?php echo $this->lang->line('issue_and_return'); ?></a></li>
                                <?php } ?>
                                <?php if(has_permission(VIEW, 'library', 'ebook')){ ?>
                                    <li><a href="<?php echo site_url('library/ebook/index'); ?>"><?php echo $this->lang->line('e_book'); ?></a></li>
                                <?php } ?>    
                            </ul>
                        </li> 
                    <?php } }?>
                        
          
        </ul>
      </div>

    </div>
    <!-- /sidebar menu -->

    <!-- /menu footer buttons -->
    <div class="sidebar-footer hidden-small">
      <a data-toggle="tooltip" data-placement="top" title="Settings">
        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="FullScreen">
        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="Lock">
        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="Logout">
        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
      </a>
    </div>
    <!-- /menu footer buttons -->
  </div>
</div>


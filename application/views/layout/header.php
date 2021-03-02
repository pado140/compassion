<!-- top navigation -->
<?php
    $photo = $this->session->userdata('photo');
    $role_id = $this->session->userdata('role_id');
    $path = '';
    $realpath='';
    if($role_id == CHILDREN){ $path = 'child'; }
    elseif($role_id == MONITER){ $path = 'moniter'; }
    elseif($role_id == LIBRARIN){ $path = 'librarin'; }
    else{ $path = 'employee'; }
    if ($photo != '')
        $realpath=UPLOAD_PATH.'/'.$path.'-photo/'.$photo;
    else 
        $realpath=IMG_URL.'/default-user.png';       
?>
<div class="top_nav">
  <div class="nav_menu">
    <nav>
      <div class="nav toggle">
        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
      </div>

      <ul class="nav navbar-nav navbar-right">
        <li class="">
          <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <img src="<?=$realpath;?>" alt=""><?=$this->session->userdata('name');?>
            <span class=" fa fa-angle-down"></span>
          </a>
          <ul class="dropdown-menu dropdown-usermenu pull-right">
            <li><a href="<?php echo site_url('profile/index'); ?>">  <?php echo $this->lang->line('profile'); ?></a></li>
            <li>
              <a href="javascript:;">
                <span class="badge bg-red pull-right">50%</span>
                <span>Settings</span>
              </a>
            </li>
            <li><a href="javascript:;">Help</a></li>
            <li><a href="<?php echo site_url('profile/password'); ?>"><?php echo $this->lang->line('reset_password'); ?></a></li>
            <li><a href="<?php echo site_url('auth/logout'); ?>"><i class="fa fa-sign-out pull-left"></i> <?php echo $this->lang->line('logout'); ?></a></li>
          </ul>
        </li>

      </ul>
    </nav>
  </div>
</div>
<!-- /top navigation -->

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-lock"></i><small> <?php echo $this->lang->line('my_profile'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
           <div class="x_content quick-link">
                 <strong><?php echo $this->lang->line('quick_link'); ?>:</strong>                
                 <a href="<?php echo site_url('profile'); ?>"><?php echo $this->lang->line('my_profile'); ?></a>
                | <a href="<?php echo site_url('profile/password'); ?>"><?php echo $this->lang->line('reset_password'); ?></a>
                
                
                          
               | <a href="<?php echo site_url('auth/logout'); ?>"><?php echo $this->lang->line('logout'); ?></a>                 
            </div>
            <div class="x_content">
                <div class="" data-example-id="togglable-tabs">
                    <ul  class="nav nav-tabs bordered">
                        <li class="<?php if(isset($info)){ echo 'active'; }?>"><a href="#tab_profile"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-eye"></i> <?php echo $this->lang->line('profile'); ?></a> </li>
                        <li  class="<?php if(isset($update)){ echo 'active'; }?>"><a href="#tab_update"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('update'); ?></a> </li>
                    </ul>
                    <br/>
                    
                    <div class="tab-content">                  

                        <div  class="tab-pane fade in <?php if(isset($info)){ echo 'active'; }?>" id="tab_profile">
                            <div class="x_content">  
                                <div class="col-md-12">
                                    <div class="profile_img">
                                        <?php if($profile->photo){ ?>
                                            <img src="<?php echo UPLOAD_PATH; ?>/child-photo/<?php echo $profile->photo; ?>" alt="" width="100" />
                                        <?php }else{ ?>
                                            <img class="" src="<?php echo IMG_URL; ?>default-user.png" width="100" alt="Avatar" title="Change the avatar">
                                        <?php } ?>
                                        <h3><?php echo $profile->nom.' '.$profile->prenom; ?></h3><br/>
                                      </div>
                                  </div>
                                
                                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                    <tbody>
                                        <tr>
                                            <th width="18%"><?php echo $this->lang->line('lastname'); ?></th>
                                            <td width="32%"><?php echo $profile->nom; ?></td>
                                            <th width="18%"><?php echo $this->lang->line('firstname'); ?></th>
                                            <td width="32%"><?php echo $profile->prenom; ?></td>
                                        </tr>                                                                                
                                        <tr>
                                            <th><?php echo $this->lang->line('code'); ?></th>
                                            <td><?php echo $profile->code; ?></td>
                                            <th><?php echo $this->lang->line('birth_date'); ?></th>
                                            <td><?php echo date($this->gsms_setting->sms_date_format, strtotime($profile->datenaissance)); ?></td>
                                        </tr>                                                                                
                                                                                                                       
                                        <tr>
                                            <th><?php echo $this->lang->line('email'); ?></th>
                                            <td><?php echo $profile->email; ?></td>
                                            
                                            <th><?php echo $this->lang->line('gender'); ?></th>
                                            <td><?php echo $this->lang->line($profile->sexe); ?></td>
                                        </tr>                                                                               
                                                                                                                       
                                       
                                        <tr>
                                            <th><?php echo $this->lang->line('library'); ?> <?php echo $this->lang->line('member'); ?></th>
                                            <td><?php echo $profile->is_library_member ?  $this->lang->line('yes') : $this->lang->line('no'); ?></td>
                                            <th><?php echo $this->lang->line('hostel'); ?> <?php echo $this->lang->line('member'); ?></th>
                                            <td><?php echo !isset($profile->is_hostel_member) ? $this->lang->line('yes') : $this->lang->line('no'); ?></td>
                                        </tr>                                                                        
                                        
                                        <tr>
                                            <th><?php echo $this->lang->line('created'); ?></th>
                                            <td><?php echo date($this->gsms_setting->sms_date_format, strtotime($profile->created)); ?></td>
                                            <th><?php echo $this->lang->line('modified'); ?></th>
                                            <td><?php echo date($this->gsms_setting->sms_date_format, strtotime($profile->modified)); ?></td>
                                        </tr>                                                                        
                                        
                                    </tbody> 
                                </table> 
                            </div>
                        </div>  
                        
                        <div class="tab-pane fade in" id="tab_update">
                             <div class="x_content"> 
                            <?php echo form_open_multipart(site_url('profile/update/'. $profile->id), array('name' => 'profile', 'id' => 'profile', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                                               
                                <div class="row">                  
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <h5  class="column-title"><strong><?php echo $this->lang->line('basic informations'); ?>:</strong></h5>
                                    </div>
                                </div>
                                
                                <div class="row">                  
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="nom"><?php echo $this->lang->line('lastname'); ?> <span class="required">*</span></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="nom"  id="nom" value="<?php echo isset($child->nom) ?  $child->nom: ''; ?>" placeholder="<?php echo $this->lang->line('lastname'); ?>" required="required" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('nom'); ?></div> 
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="prenom"><?php echo $this->lang->line('firstname'); ?><span class="required">*</span></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="prenom"  id="prenom" value="<?php echo isset($child->prenom) ?  $child->prenom : ''; ?>" placeholder="<?php echo $this->lang->line('firstname'); ?>" type="text" autocomplete="off" required/>
                                            <div class="help-block"><?php echo form_error('prenom'); ?></div> 
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label  for="dob"><?php echo $this->lang->line('birth_date'); ?> <span class="required">*</span></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="dob"  id="add_dob" value="<?php echo isset($child->datenaissance) ?  $child->datenaissance : ''; ?>" placeholder="<?php echo $this->lang->line('birth_date'); ?>" required="required" type="date" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('dob'); ?></div>
                                         </div>
                                    </div>
                                    
                                </div>
                                
                                <div class="row">                                    
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                             <label for="gender"><?php echo $this->lang->line('gender'); ?> <span class="required">*</span></label>
                                              <select  class="form-control col-md-7 col-xs-12"  name="gender"  id="gender" required="required">
                                                <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                                <?php $genders = get_genders(); ?>
                                                <?php foreach($genders as $key=>$value){ ?>
                                                    <option value="<?php echo $key; ?>" <?php echo isset($child->sexe) && $child->sexe == $key ?  'selected="selected"' : ''; ?>><?php echo $value; ?></option>
                                                <?php } ?>
                                            </select>
                                            <div class="help-block"><?php echo form_error('gender'); ?></div>
                                         </div>
                                     </div>
                                    
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                              <label for="code"><?php echo $this->lang->line('code'); ?><span class="required">*</span></label>
                                              <input  class="form-control col-md-7 col-xs-12"  name="code"  id="code" value="<?php echo isset($child->code) ?  $child->code : ''; ?>" placeholder="<?php echo $this->lang->line('code'); ?>" type="text">
                                               <div class="help-block"><?php echo form_error('code'); ?></div>
                                         </div>
                                     </div>
                                </div>
                               <div class="row">                  
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <h5 class="column-title"><strong><?php echo $this->lang->line('other'); ?> <?php echo $this->lang->line('information'); ?>:</strong></h5>
                                    </div>
                                </div>    
                                <div class="row"> 
                                 <div class="col-md-3 col-sm-3 col-xs-12">
                                     <div class="item form-group">
                                        <label for="email"><?php echo $this->lang->line('email'); ?> <span class="required">*</span></label>
                                        <input  class="form-control col-md-7 col-xs-12"  name="email"  id="email" value="<?php echo isset($child->email) ?  $child->email : ''; ?>" placeholder="<?php echo $this->lang->line('email'); ?>" required="email" type="email" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('email'); ?></div>
                                     </div>
                                 </div>
                                 <div class="col-md-3 col-sm-3 col-xs-12">
                                     <div class="item form-group">
                                        <label for="password"><?php echo $this->lang->line('password'); ?> <span class="required">*</span></label>
                                        <input  class="form-control col-md-7 col-xs-12"  name="password"  id="password" value="" placeholder="<?php echo $this->lang->line('password'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('password'); ?></div>
                                     </div>
                                 </div>
                                 <div class="col-md-3 col-sm-3 col-xs-12">
                                     <div class="item form-group">
                                        <label for="health_condition"><?php echo $this->lang->line('health_condition'); ?> </label>
                                        <input  class="form-control col-md-7 col-xs-12"  name="health_condition"  id="health_condition" value="<?php echo isset($post['health_condition']) ?  $post['health_condition'] : ''; ?>" placeholder="<?php echo $this->lang->line('health_condition'); ?>" type="text">
                                        <div class="help-block"><?php echo form_error('health_condition'); ?></div>
                                     </div>
                                 </div>
                            </div>
                                <div class="row">                                     
                                     <div class="col-md-6 col-sm-6 col-xs-12">
                                         <div class="item form-group">
                                            <label for="other_info"><?php echo $this->lang->line('other_info'); ?></label> 
                                            <textarea  class="form-control col-md-6 col-xs-12 textarea-4column"  name="other_info"  id="other_info" placeholder="<?php echo $this->lang->line('other_info'); ?>"><?php echo isset($post['other_info']) ?  $post['other_info'] : ''; ?></textarea>
                                            <div class="help-block"><?php echo form_error('other_info'); ?></div>
                                         </div>
                                     </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label ><?php echo $this->lang->line('children'); ?>  <?php echo $this->lang->line('photo'); ?></label>
                                            <div class="btn btn-default btn-file">
                                                <i class="fa fa-paperclip"></i> <?php echo $this->lang->line('upload'); ?>
                                                <input  class="form-control col-md-7 col-xs-12"  name="photo"  id="photo" type="file">
                                            </div>
                                            <div class="text-info"><?php echo $this->lang->line('valid_file_format_img'); ?></div>
                                            <div class="help-block"><?php echo form_error('photo'); ?></div>
                                        </div>
                                    </div>
                                     <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                             <input type="hidden" name="prev_photo" id="prev_photo" value="<?php echo $child->photo; ?>" />
                                            <?php if($child->photo){ ?>
                                            <img src="<?php echo UPLOAD_PATH; ?>/child-photo/<?php echo $child->photo; ?>" alt="" width="70" /><br/><br/>
                                            <?php } ?>
                                         </div>
                                     </div>                                      
                                </div>
                                
                                
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <a href="<?php echo site_url('profile'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
                                        <input type="hidden" name="id" id="id" value="<?php echo $profile->id; ?>" />
                                        <input type="hidden" name="user_type" id="user_type" value="student" />
                                        <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('update'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>  
                              
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade bs-activity-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><?php echo $this->lang->line('activity'); ?> <?php echo $this->lang->line('information'); ?></h4>
        </div>
        <div class="modal-body fn_activity_data">
            
        </div>       
      </div>
    </div>
</div>
<script type="text/javascript">
         
    function get_activity_modal(activity_id){
         
        $('.fn_activity_data').html('<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="<?php echo IMG_URL; ?>loading.gif" /></p>');
        $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('student/activity/get_single_activity'); ?>",
          data   : {activity_id : activity_id},  
          success: function(response){                                                   
             if(response)
             {
                $('.fn_activity_data').html(response);
             }
          }
       });
    }
</script>

  <!-- bootstrap-datetimepicker -->
 <link href="<?php echo VENDOR_URL; ?>datepicker/datepicker.css" rel="stylesheet">
 <script src="<?php echo VENDOR_URL; ?>datepicker/datepicker.js"></script>
 <script type="text/javascript">
     
  $('#edit_dob').datepicker();
  $('#joining_date').datepicker();
  $("#profile").validate(); 
  </script> 
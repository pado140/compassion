<?php
  $role_id=$this->session->userdata('role_id');
  ?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-users"></i><small> <?php echo $this->lang->line('manage_children'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
           <div class="x_content quick-link">
                <strong> <?php echo $this->lang->line('quick_link'); ?>: </strong>
                <?php if(has_permission(ADD, 'children', 'children')){ ?>
                    <a href="<?php echo site_url('children/add'); ?>"><?php echo $this->lang->line('admit'); ?> <?php echo $this->lang->line('children'); ?></a> |
                 <?php } ?>
                <?php if(has_permission(ADD, 'children', 'children')){ ?>
                    <a href="<?php echo site_url('children/advanced'); ?>"><?php echo $this->lang->line('advanced'); ?> <?php echo $this->lang->line('admission'); ?></a> |
                 <?php } ?>
                <?php if(has_permission(VIEW, 'children', 'children')){ ?>
                    <a href="<?php echo site_url('children/index'); ?>"><?php echo $this->lang->line('manage_student'); ?></a> |                   
                 <?php } ?>
            </div>
            <div class="x_content">
                <div class="" data-example-id="togglable-tabs">
                    
                    <ul  class="nav nav-tabs bordered">
                        <li class="<?php if(isset($list)){ echo 'active'; }?>"><a href="#tab_student_list"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list-ol"></i> <?php echo $this->lang->line('children'); ?> <?php echo $this->lang->line('list'); ?></a> </li>
                        <?php if(has_permission(ADD, 'children', 'children')){ ?>
                            <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="#tab_add_student"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo $this->lang->line('add'); ?> <?php echo $this->lang->line('children'); ?></a> </li>                          
                        <?php } ?>
                        <?php if(isset($edit)){ ?>
                            <li  class="active"><a href="#tab_edit_student"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('edit'); ?> <?php echo $this->lang->line('children'); ?></a> </li>                          
                        <?php } ?>
                     
                    </ul>
                    <br/>
                    
                    <div class="tab-content">
                        <div  class="tab-pane fade in <?php if(isset($list)){ echo 'active'; }?>" id="tab_student_list" >
                            <div class="x_content">
                              <?php 
                              if($role_id!=CHILDREN){
                                if(isset($children) && !empty($children)){ 
                                  foreach($children as $obj){
                                ?>
                                  <div class="col-md-4 col-sm-4 col-xs-12 profile_details">
                                    <div class="well profile_view">
                                      <div class="col-sm-12">
                                        <h4 class="brief"><i>Digital Strategist</i></h4>
                                        <div class="left col-xs-7">
                                          <h2><?=$obj->nom.' '.$obj->prenom;?></h2>
                                          <p><strong>A propos: </strong> né le <?=$obj->datenaissance;?>/ admis au programme <?=$obj->code;?>Coffee Lover </p>
                                          <ul class="list-unstyled">
                                            <li><i class="fa fa-building"></i> Address: </li>
                                            <li><i class="fa fa-phone"></i> Phone #: </li>
                                          </ul>
                                        </div>
                                        <div class="right col-xs-5 text-center">
                                          <?php  if($obj->photo != ''){ ?>
                                                <img src="<?php echo UPLOAD_PATH; ?>/child-photo/<?php echo $obj->photo; ?>" alt="" class="img-circle img-responsive" /> 
                                                <?php }else{ ?>
                                                <img src="<?php echo IMG_URL; ?>/default-user.png" alt="" class="img-circle img-responsive"/> 
                                                <?php } ?>
                                        </div>
                                      </div>
                                      <div class="col-xs-12 bottom text-center">
                                        
                                        <div class="col-xs-12 col-sm-6 emphasis">

                                          <?php if(has_permission(EDIT, 'children', 'children')){ ?>
                                                        <a href="<?php echo site_url('children/edit/'.$obj->id); ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('edit'); ?> </a><br/>
                                                    <?php } ?>
                                                    
                                                    <?php if(has_permission(DELETE, 'children', 'children')){ ?>
                                                        <a href="<?php echo site_url('children/delete/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo $this->lang->line('confirm_alert'); ?>');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('delete'); ?> </a>
                                                    <?php } ?>
                                          <button type="button" class="btn btn-primary btn-xs" onclick="get_children_modal(<?php echo $obj->id; ?>);"  data-toggle="modal" data-target=".bs-children-modal-lg">
                                            <i class="fa fa-user"> </i> View Profile
                                          </button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                            <?php
                              }}}else{
                            ?>
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('sl_no'); ?></th>
                                        <th><?php echo $this->lang->line('photo'); ?></th>
                                        <th><?php echo $this->lang->line('name'); ?></th>
                                        <th><?php echo $this->lang->line('code'); ?></th>
                                        <th><?php echo $this->lang->line('email'); ?></th>
                                        <?php if($this->session->userdata('role_id') != CHILDREN){ ?>
                                            <th><?php echo $this->lang->line('action'); ?></th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>   
                                    <?php  
                                    $count = 1; 
                                    if(isset($children) && !empty($children)){ 
                                        foreach($children as $obj){
                                        ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td>
                                                <?php  if($obj->photo != ''){ ?>
                                                <img src="<?php echo UPLOAD_PATH; ?>/child-photo/<?php echo $obj->photo; ?>" alt="" width="70" /> 
                                                <?php }else{ ?>
                                                <img src="<?php echo IMG_URL; ?>/default-user.png" alt="" width="70" /> 
                                                <?php } ?>
                                            </td>
                                            <td><?php echo ucfirst($obj->nom).' '.ucfirst($obj->prenom); ?></td>
                                            <td><?php echo $obj->code; ?></td>
                                            <td><?php echo $obj->email; ?></td>
                                             <?php if($this->session->userdata('role_id') != CHILDREN){ ?>
                                                <td>
                                                    <?php if(has_permission(EDIT, 'children', 'children')){ ?>
                                                        <a href="<?php echo site_url('children/edit/'.$obj->id); ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('edit'); ?> </a><br/>
                                                    <?php } ?>
                                                    <?php if(has_permission(VIEW, 'children', 'children')){ ?>
                                                        <a href="javascript:void(0);" onclick="get_children_modal(<?php echo $obj->id; ?>);"  data-toggle="modal" data-target=".bs-children-modal-lg" class="btn btn-success btn-xs"><i class="fa fa-eye"></i> <?php echo $this->lang->line('view'); ?> </a>
                                                    <?php } ?>
                                                    <?php if(has_permission(DELETE, 'children', 'children')){ ?>
                                                        <a href="<?php echo site_url('children/delete/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo $this->lang->line('confirm_alert'); ?>');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('delete'); ?> </a>
                                                    <?php } ?>
                                                </td>
                                            <?php } ?> 
                                        </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <?php } ?>
                            </div>
                        </div>

                        <div  class="tab-pane fade in <?php if(isset($add)){ echo 'active'; }?>" id="tab_add_student">
                            <div class="x_content"> 
                               <?php echo form_open_multipart(site_url('children/add'), array('name' => 'add', 'id' => 'add', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                
                                <div class="row">                  
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <h5  class="column-title"><strong><?php echo $this->lang->line('basic informations'); ?>:</strong></h5>
                                    </div>
                                </div>
                                
                                <div class="row">                  
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="nom"><?php echo $this->lang->line('lastname'); ?> <span class="required">*</span></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="nom"  id="nom" value="<?php echo isset($post['nom']) ?  $post['nom'] : ''; ?>" placeholder="<?php echo $this->lang->line('lastname'); ?>" required="required" type="text" autocomplete="off">
                                            <div class="help-block"><?php echo form_error('nom'); ?></div> 
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="prenom"><?php echo $this->lang->line('firstname'); ?><span class="required">*</span></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="prenom"  id="prenom" value="<?php echo isset($post['prenom']) ?  $post['prenom'] : ''; ?>" placeholder="<?php echo $this->lang->line('firstname'); ?>" type="text" autocomplete="off" required/>
                                            <div class="help-block"><?php echo form_error('prenom'); ?></div> 
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                            <label  for="dob"><?php echo $this->lang->line('birth_date'); ?> <span class="required">*</span></label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="dob"  id="add_dob" value="<?php echo isset($post['dob']) ?  $post['dob'] : ''; ?>" placeholder="<?php echo $this->lang->line('birth_date'); ?>" required="required" type="text" autocomplete="off">
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
                                                    <option value="<?php echo $key; ?>" <?php echo isset($post['gender']) && $post['gender'] == $key ?  'selected="selected"' : ''; ?>><?php echo $value; ?></option>
                                                <?php } ?>
                                            </select>
                                            <div class="help-block"><?php echo form_error('gender'); ?></div>
                                         </div>
                                     </div>
                                    
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                         <div class="item form-group">
                                              <label for="code"><?php echo $this->lang->line('code'); ?><span class="required">*</span></label>
                                              <input  class="form-control col-md-7 col-xs-12"  name="code"  id="code" value="<?php echo isset($post['code']) ?  $post['code'] : ''; ?>" placeholder="<?php echo $this->lang->line('code'); ?>" type="text">
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
                                        <input  class="form-control col-md-7 col-xs-12"  name="email"  id="email" value="<?php echo isset($post['email']) ?  $post['email'] : ''; ?>" placeholder="<?php echo $this->lang->line('email'); ?>" required="email" type="email" autocomplete="off">
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
                                         </div>
                                     </div>                                    
                                </div>
                                
                                
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <input type="hidden" id="role_id" name="role_id" value="<?php echo CHILDREN; ?>" />
                                        <a  href="<?php echo site_url('children'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('submit'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                                
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="instructions"><strong><?php echo $this->lang->line('instruction'); ?>: </strong> Veuillez remplir les informations requis</div>
                                </div>
                                
                            </div>
                        </div>  

                        <?php if(isset($edit)){ ?>
                        
                        <div class="tab-pane fade in active" id="tab_edit_student">
                            <div class="x_content"> 
                            <?php echo form_open_multipart(site_url('children/edit/'. $child->id), array('name' => 'edit', 'id' => 'edit', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                
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
                                
                                <?php var_dump($child);?>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">                                        
                                        <input type="hidden" name="id" id="id" value="<?php echo $child->id; ?>" />
                                        <a href="<?php echo site_url('children'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('update'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div> 
                        <?php } ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bs-children-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><?php echo $this->lang->line('children'); ?> <?php echo $this->lang->line('information'); ?></h4>
        </div>
        <div class="modal-body fn_children_data">
            
        </div>       
      </div>
    </div>
</div>
<script type="text/javascript">
         
    function get_children_modal(id){
         
        $('.fn_children_data').html('<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="<?php echo IMG_URL; ?>loading.gif" /></p>');
        $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('children/get_single_children'); ?>",
          data   : {children_id : id},  
          success: function(response){                                                   
             if(response)
             {
                $('.fn_children_data').html(response);
             }
          }
       });
    }
</script>


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
          url    : "<?php echo site_url('children/activity/get_single_activity'); ?>",
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
<!-- datatable with buttons -->
 <script type="text/javascript">
     
    $('#add_admission_date').datepicker();
    $('#edit_admission_date').datepicker();
    $('#add_dob').datepicker({ startView: 2 });
    $('#edit_dob').datepicker({ startView: 2 });
  
    <?php if(isset($post['class_id']) && isset($post['section_id'])){ ?>
        get_section_by_class('<?php echo $post['class_id']; ?>', '<?php echo $post['section_id']; ?>', 'add');
    <?php } ?>
    <?php if(isset($edit)){ ?>
        get_section_by_class('<?php echo $children->class_id; ?>', '<?php echo $children->section_id; ?>', 'edit');
    <?php } ?>
    
    function get_section_by_class(class_id, section_id, type){       
           
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_section_by_class'); ?>",
            data   : { class_id : class_id , section_id: section_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {
                  $('#'+type+'_section_id').html(response);                   
               }
            }
        });  
                     
        
   }
  </script>
  <!-- datatable with buttons -->
 <script type="text/javascript">
        $(document).ready(function() {
          $('#datatable-responsive').DataTable( {
              dom: 'Bfrtip',
              iDisplayLength: 15,
              buttons: [
                  'copyHtml5',
                  'excelHtml5',
                  'csvHtml5',
                  'pdfHtml5',
                  'pageLength'
              ],
              search: true
          });
        });
        
        function get_student_by_class(url){          
            if(url){
                window.location.href = url; 
            }
        }
        
        function check_guardian_type(guardian_type){
           
            $('#add_relation_with').val('');  
            $('#add_gud_name').val('');  
            $('#add_gud_phone').val('');  
            $('#add_gud_present_address').val('');  
            $('#add_gud_permanent_address').val('');  
            $('#add_gud_religion').val(''); 
            $('#add_gud_profession').val(''); 
            $('#add_gud_national_id').val(''); 
            $('#add_gud_email').val(''); 
            $('#add_gud_other_info').val(''); 
                    
           if(guardian_type == 'father'){
               
               $('#add_relation_with').val('<?php echo $this->lang->line('father'); ?>'); 
               $('.fn_existing_guardian').hide();
               $('.fn_except_exist').show();
               $('#guardian_id').prop('required', false);               
               $('#add_gud_name').prop('required', true);               
               $('#add_gud_phone').prop('required', true);               
               $('#add_gud_email').prop('required', true);               
               
               var f_name = $('#add_father_name').val();
               var f_phone = $('#add_father_phone').val(); 
               var f_education = $('#add_father_education').val(); 
               var f_profession = $('#add_father_profession').val(); 
               var f_designation = $('#add_father_designation').val(); 
               
               $('#add_gud_name').val(f_name);  
               $('#add_gud_phone').val(f_phone); 
               $('#add_gud_profession').val(f_profession); 
               
           }else if(guardian_type == 'mother'){
               
               $('#add_relation_with').val('<?php echo $this->lang->line('mother'); ?>');   
               $('.fn_existing_guardian').hide();
               $('.fn_except_exist').show();
               $('#guardian_id').prop('required', false);
               $('#add_gud_name').prop('required', true);               
               $('#add_gud_phone').prop('required', true);               
               $('#add_gud_email').prop('required', true); 
               
               var m_name = $('#add_mother_name').val();
               var m_phone = $('#add_mother_phone').val(); 
               var m_education = $('#add_mother_education').val(); 
               var m_profession = $('#add_mother_profession').val(); 
               var m_designation = $('#add_mother_designation').val(); 
               
               $('#add_gud_name').val(m_name);  
               $('#add_gud_phone').val(m_phone); 
               $('#add_gud_profession').val(m_profession); 
               
           }else if(guardian_type == 'other'){
               $('#add_relation_with').val('<?php echo $this->lang->line('other'); ?>');    
               $('.fn_existing_guardian').hide();
               $('.fn_except_exist').show();
               $('#guardian_id').prop('required', false);
               $('#add_gud_name').prop('required', true);               
               $('#add_gud_phone').prop('required', true);               
               $('#add_gud_email').prop('required', true); 
                              
           }else if(guardian_type == 'exist_guardian'){
               $('.fn_existing_guardian').show();
               $('.fn_except_exist').hide();
               $('#guardian_id').prop('required', true);   
               $('#add_gud_name').prop('required', false);               
               $('#add_gud_phone').prop('required', false);               
               $('#add_gud_email').prop('required', false); 
               
           }else{
                $('#add_relation_with').val('');   
                $('.fn_existing_guardian').hide();
                $('.fn_except_exist').show();
                $('#guardian_id').prop('required', false);
                $('#add_gud_name').prop('required', true);               
                $('#add_gud_phone').prop('required', true);               
                $('#add_gud_email').prop('required', true); 
           }
        
        }
        
        function get_guardian_by_id(guardian_id){                       
            
            $.ajax({       
            type   : "POST",
            dataType: "json",
            url    : "<?php echo site_url('ajax/get_guardian_by_id'); ?>",
            data   : { guardian_id : guardian_id},               
            async  : true,
            success: function(response){ 
               if(response)
               {
                    $('#add_gud_name').val(response.name);  
                    $('#add_gud_phone').val(response.phone);  
                    $('#add_gud_present_address').val(response.present_address);  
                    $('#add_gud_permanent_address').val(response.permanent_address);  
                    $('#add_gud_religion').val(response.religion);  
                    $('#add_gud_profession').val(response.profession);  
                    $('#add_gud_national_id').val(response.national_id);  
                    $('#add_gud_email').val(response.email);  
                    $('#add_gud_other_info').val(response.other_info);  
               }
               else
               {
                    $('#add_relation_with').val('');  
                    $('#add_gud_name').val('');  
                    $('#add_gud_phone').val('');  
                    $('#add_gud_present_address').val('');  
                    $('#add_gud_permanent_address').val('');  
                    $('#add_gud_religion').val(''); 
                    $('#add_gud_profession').val(''); 
                    $('#add_gud_national_id').val(''); 
                    $('#add_gud_email').val(''); 
                    $('#add_gud_other_info').val(''); 
               }
            }
        });  
        
        }
        
             
    $('#same_as_guardian').on('click', function(){
        
        if($(this).is(":checked")) {
            var present =  $('#add_gud_present_address').val();  
            var permanent = $('#add_gud_permanent_address').val();  
            $('#add_present_address').val(present);  
            $('#add_permanent_address').val(permanent);  
        }else{
             $('#add_present_address').val('');  
             $('#add_permanent_address').val(''); 
        }
    });
    
    $("#add").validate();     
    $("#edit").validate();      
</script>
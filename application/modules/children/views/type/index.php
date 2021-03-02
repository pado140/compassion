<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-users"></i><small> <?php echo $this->lang->line('manage'); ?> <?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('type'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content quick-link">
                <strong> <?php echo $this->lang->line('quick_link'); ?>: </strong>
                <?php if(has_permission(VIEW, 'student', 'type')){ ?>
                    <a href="<?php echo site_url('student/type/index'); ?>"> <?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('type'); ?></a> |
                 <?php } ?>
                <?php if(has_permission(VIEW, 'student', 'group')){ ?>
                    <a href="<?php echo site_url('student/group/index'); ?>"> <?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('group'); ?></a> |
                 <?php } ?>
                <?php if(has_permission(ADD, 'student', 'student')){ ?>
                    <a href="<?php echo site_url('student/add'); ?>"><?php echo $this->lang->line('admit'); ?> <?php echo $this->lang->line('student'); ?></a> |
                 <?php } ?>
                <?php if(has_permission(ADD, 'student', 'student')){ ?>
                    <a href="<?php echo site_url('student/advanced'); ?>"><?php echo $this->lang->line('advanced'); ?> <?php echo $this->lang->line('admission'); ?></a> |
                 <?php } ?>
                <?php if(has_permission(ADD, 'student', 'bulk')){ ?>
                    <a href="<?php echo site_url('student/bulk/add'); ?>"><?php echo $this->lang->line('bulk'); ?> <?php echo $this->lang->line('admission'); ?></a> |
                 <?php } ?>
                <?php if(has_permission(VIEW, 'student', 'student')){ ?>
                    <a href="<?php echo site_url('student/index'); ?>"><?php echo $this->lang->line('manage_student'); ?></a> |                   
                 <?php } ?>
                <?php if(has_permission(VIEW, 'student', 'activity')){ ?>
                    <a href="<?php echo site_url('student/activity/index'); ?>"> <?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('activity'); ?></a>                    
                 <?php } ?>
            </div>
            <div class="x_content">
                <div class="" data-example-id="togglable-tabs">                    
                    <ul  class="nav nav-tabs bordered">
                        <li class="<?php if(isset($list)){ echo 'active'; }?>"><a href="#tab_type_list"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list-ol"></i> <?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('type'); ?> <?php echo $this->lang->line('list'); ?></a> </li>
                        <?php if(has_permission(ADD, 'student', 'type')){ ?>
                             <?php if(isset($edit)){ ?>
                                <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="<?php echo site_url('student/type/add'); ?>"  aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo $this->lang->line('add'); ?> <?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('type'); ?></a> </li>                          
                             <?php }else{ ?>
                                <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="#tab_add_type"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo $this->lang->line('add'); ?> <?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('type'); ?></a> </li>                          
                             <?php } ?>
                        <?php } ?> 
                        <?php if(isset($edit)){ ?>
                            <li  class="active"><a href="#tab_edit_type"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('edit'); ?> <?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('type'); ?></a> </li>                          
                        <?php } ?>
                                                      
                    </ul>
                    <br/>
                    
                    <div class="tab-content">
                        <div  class="tab-pane fade in <?php if(isset($list)){ echo 'active'; }?>" id="tab_type_list" >
                            <div class="x_content">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('id'); ?></th>                                       
                                        <th><?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('type'); ?></th>
                                        <th><?php echo $this->lang->line('note'); ?></th>
                                        <th><?php echo $this->lang->line('action'); ?></th>                                            
                                    </tr>
                                </thead>
                                <tbody>   
                                    <?php  $count = 1; if(isset($types) && !empty($types)){ ?>
                                        <?php foreach($types as $obj){ ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>                                            
                                            <td><?php echo $obj->type; ?></td>
                                            <td><?php echo $obj->note; ?></td>
                                            <td>
                                                <?php if(has_permission(EDIT, 'student', 'type')){ ?>
                                                    <a href="<?php echo site_url('student/type/edit/'.$obj->id); ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('edit'); ?> </a>
                                                <?php } ?>
                                                <?php if(has_permission(DELETE, 'student', 'type')){ ?>
                                                    <a href="<?php echo site_url('student/type/delete/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo $this->lang->line('confirm_alert'); ?>');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('delete'); ?> </a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                            </div>
                        </div>

                        <div  class="tab-pane fade in <?php if(isset($add)){ echo 'active'; }?>" id="tab_add_type">
                            <div class="x_content"> 
                               <?php echo form_open(site_url('student/type/add'), array('name' => 'add', 'id' => 'add', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                                    
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type"><?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('type'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="type"  id="type" value="<?php echo isset($post['type']) ?  $post['type'] : ''; ?>" placeholder="<?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('type'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('type'); ?></div>
                                    </div>
                                </div> 
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="note"><?php echo $this->lang->line('note'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="note"  id="note" placeholder="<?php echo $this->lang->line('note'); ?>"><?php echo isset($post['note']) ?  $post['note'] : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('note'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <a  href="<?php echo site_url('student/type/index'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('submit'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>  

                        <?php if(isset($edit)){ ?>
                        <div class="tab-pane fade in active" id="tab_edit_type">
                            <div class="x_content"> 
                               <?php echo form_open(site_url('student/type/edit/'.$type->id), array('name' => 'edit', 'id' => 'edit', 'class'=>'form-horizontal form-label-left'), ''); ?>
                             
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type"><?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('type'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">                                        
                                        <input  class="form-control col-md-7 col-xs-12"  name="type" value="<?php echo isset($type) ? $type->type : ''; ?>"  placeholder="<?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('type'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('type'); ?></div>
                                    </div>
                                </div>    
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="note"><?php echo $this->lang->line('note'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="note"  id="note" placeholder="<?php echo $this->lang->line('note'); ?>"><?php echo isset($type) ? $type->note : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('note'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <input type="hidden" value="<?php echo isset($type) ? $type->id : ''; ?>" name="id" />
                                        <a href="<?php echo site_url('student/type/index'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
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
              search: true,              
              responsive: true
          });
        });
        
    $("#add").validate();     
    $("#edit").validate();      
</script>